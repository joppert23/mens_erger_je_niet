#######################################
# Copyright (c) 2021 Maker Portal LLC
# Author: Joshua Hrisko
#######################################
#
# NEMA 17 (17HS4023) Raspberry Pi Tests
# --- rotating the NEMA 17 to test
# --- wiring and motor functionality
#
#
#######################################
#
import RPi.GPIO as GPIO
from RpiMotorLib import RpiMotorLib
import time

################################
# RPi and Motor Pre-allocations
################################
#
#define GPIO pins
direction = 2 # Direction (DIR) GPIO Pin
step = 3 # Step GPIO Pin
EN_pin = 4 # enable pin (LOW to enable)
# 1 ground naar de pi en een ground naar de voeding
# RESET = high voor GEEN reset
# SLEEP = high voor GEEN SLEEP


# Declare a instance of class pass GPIO pins numbers and the motor type
def motortest():
    direction = 2 # Direction (DIR) GPIO Pin
    step = 3 # Step GPIO Pin
    EN_pin = 4 # enable pin (low to enable)

    mymotortest = RpiMotorLib.A4988Nema(direction, step, (21,21,21), "DRV8825")
    GPIO.setup(EN_pin,GPIO.OUT) # set enable pin as output

    ###########################
    # Actual motor control
    ###########################
    for i in range(30):
        GPIO.output(EN_pin,GPIO.LOW) # pull enable to low to enable motor
        mymotortest.motor_go(False, # True=Clockwise, False=Counter-Clockwise
                        "Full" , # Step type (Full,Half,1/4,1/8,1/16,1/32)
                         400, # number of steps
                         .0008, # step delay [sec]
                         False, # True = print verbose output 
                         .05) # initial delay [sec]        
        
    #GPIO.cleanup()
while True:
    for _ in range(1):
        motortest()

