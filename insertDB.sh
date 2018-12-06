#!/bin/bash
trap "exit" INT

while true

do

python /home/pi/insertDB.py -e

sleep 1

done
