
#include <Wire.h>
#include <SDL_Arduino_INA3221.h>

SDL_Arduino_INA3221 ina3221_A(0x41);
SDL_Arduino_INA3221 ina3221_B(0x40);

#define SOLOAR_PANEL_CHANNEL 1
#define TURBINE_CHANNEL 2
#define GRID_CHANNEL 3
#define PUMP_CHANNEL 2


void setup(void) 
{
  if(!Serial) {
    Serial.println("Please connect sensor");
  }
    
  Serial.begin(115200);
  //Serial.println("SDA_Arduino_INA3221_Test");
  
  //Serial.println("Measuring voltage and current with ina3221 ...");
  ina3221_A.begin();
  ina3221_B.begin();
}

void loop(void) 
{
  
  //Serial.println("------------------------------");
  float shuntvoltage_A1 = 0;
  float busvoltage_A1 = 0;
  float current_mA_A1 = 0;
  float loadvoltage_A1 = 0;
  float power_A1 = 0;
  
  float shuntvoltage_A2 = 0;
  float busvoltage_A2 = 0;
  float current_mA_A2 = 0;
  float loadvoltage_A2 = 0;
  float power_A2 = 0;
  
  float shuntvoltage_B1 = 0;
  float busvoltage_B1 = 0;
  float current_mA_B1 = 0;
  float loadvoltage_B1 = 0;
  float power_B1 = 0;
  
  float shuntvoltage_A3 = 0;
  float busvoltage_A3 = 0;
  float current_mA_A3 = 0;
  float loadvoltage_A3 = 0;
  float power_A3 = 0;


  busvoltage_A1 = ina3221_A.getBusVoltage_V(SOLOAR_PANEL_CHANNEL);
  shuntvoltage_A1 = ina3221_A.getShuntVoltage_mV(SOLOAR_PANEL_CHANNEL);
  current_mA_A1 = ina3221_A.getCurrent_mA(SOLOAR_PANEL_CHANNEL);  
  loadvoltage_A1 = busvoltage_A1 + (shuntvoltage_A1 / 1000);
  power_A1 = (loadvoltage_A1*current_mA_A1);
  
  busvoltage_A2 = ina3221_A.getBusVoltage_V(TURBINE_CHANNEL);
  shuntvoltage_A2 = ina3221_A.getShuntVoltage_mV(TURBINE_CHANNEL);
  current_mA_A2 = ina3221_A.getCurrent_mA(TURBINE_CHANNEL);
  loadvoltage_A2 = busvoltage_A2 + (shuntvoltage_A2 / 1000);
  power_A2 = (loadvoltage_A2*current_mA_A2);
  
  busvoltage_A3 = ina3221_A.getBusVoltage_V(GRID_CHANNEL);
  shuntvoltage_A3 = ina3221_A.getShuntVoltage_mV(GRID_CHANNEL);
  current_mA_A3 = ina3221_A.getCurrent_mA(GRID_CHANNEL);
  loadvoltage_A3 = busvoltage_A3 + (shuntvoltage_A3 / 1000);
  power_A3 = (loadvoltage_A3*current_mA_A3);
  
  busvoltage_B1 = ina3221_B.getBusVoltage_V(PUMP_CHANNEL);
  shuntvoltage_B1 = ina3221_B.getShuntVoltage_mV(PUMP_CHANNEL);
  current_mA_B1 = ina3221_B.getCurrent_mA(PUMP_CHANNEL);  
  loadvoltage_B1 = busvoltage_B1 + (shuntvoltage_B1 / 1000);
  power_B1 = (loadvoltage_B1*current_mA_B1);
  
  //Solar Panel Channe
  Serial.print(loadvoltage_A1); Serial.print("\t");//Serial.println(" V");
  Serial.print(current_mA_A1); Serial.print("\t");//Serial.println(" mA");
  Serial.print(power_A1); Serial.print("\t");  
  
  //Turbine Channel
  Serial.print(loadvoltage_A2); Serial.print("\t");//Serial.println(" V");
  Serial.print(current_mA_A2); Serial.print("\t");//Serial.println(" mA");
  Serial.print(power_A2); Serial.print("\t");

  
  //Grid Channel
  Serial.print(loadvoltage_A3); Serial.print("\t");//Serial.println(" V");
  Serial.print(current_mA_A3); Serial.print("\t");//Serial.println(" mA");
  Serial.print(power_A3); Serial.print("\t");


  //Pump Channel
  Serial.print(loadvoltage_B1); Serial.print("\t");//Serial.println(" V");
  Serial.print(current_mA_B1); Serial.print("\t");//Serial.println(" mA");
  Serial.print(power_B1); Serial.print("\t");
  Serial.print("\n");
  

  delay(5000);
}
