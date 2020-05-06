# Richard Schmidt de Almeida - x16126602
# BSc (Honours) in Computing - IoT Stream
# GrovePi + Grove Ultrasonic Ranger + Relay Pin

# Connect the Grove Ultrasonic Ranger to digital port D4
# SIG,NC,VCC,GND
# Connect the Grove Relay Pin to the digital port D2

#Relay_pin = 2# relay_pin will not be used as it is not necessary for this project

#pinMode(Relay_pin,"OUTPUT")

from grovepi import *
import requests as req         #import requests to be used for webqueries

ultrasonic_ranger = 4

time_to_sleep       = 5       # The main loop runs every 1.5 seconds

bin_id = 1 


while True:
    try:

        # Read distance value from Ultrasonic
        distant = ultrasonicRead(ultrasonic_ranger)
        resp=req.get("http://IP/data.php?bin_id="+str(bin_id)+"&bin_status="+str(distant))  
		
		
    except TypeError:
        print("Error")
    except IOError:
        print("Error")
		
		

    #Slow down the loop
    time.sleep(time_to_sleep)

