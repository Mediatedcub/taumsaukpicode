import serial
import time
import datetime
import MySQLdb as mdb

con = mdb.connect('localhost', 'pmauser', '8675Taker!', 'sensors');

cursor = con.cursor()
device = '/dev/ttyACM0'
try:
    print("Tying...", device)
    arduino = serial.Serial(device, 115200)

except:
    print("Failed to connect on", device)

try:
    data = arduino.readline()
    #time.sleep(1)
    #data = arduino.readline()
    pieces = data.split("\t")

    #if len(pieces) == 12:
    sp_voltage = pieces[0]
    sp_current = pieces[1]
    sp_power = pieces[2]

    t_voltage = pieces[3]
    t_current = pieces[4]
    t_power = pieces[5]

    g_voltage = pieces[6]
    g_current = pieces[7]
    g_power = pieces[8]

    p_voltage = pieces[9]
    p_current = pieces[10]
    p_power = pieces[11]
    ts = time.time()
    timestamp = datetime.datetime.fromtimestamp(ts).strftime('%Y-%m-%d %H:%M:%S')
except:
    print("failed to get data from Arduino")

try:
    cursor.execute("INSERT INTO sensorInfo(sp_voltage, sp_current, sp_power, t_voltage, t_current, t_power, g_voltage, g_current, g_power, p_voltage, p_current, p_power, time)"
                    "VALUES(%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)", (sp_voltage,sp_current,sp_power,t_voltage,t_current,t_power,g_voltage,g_current,g_power,p_voltage,p_current,p_power,timestamp))
    con.commit()
    cursor.close()
except:
    print("failed to insert data")
finally:
    cursor.close()




