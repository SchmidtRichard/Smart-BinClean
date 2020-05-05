# Richard Schmidt de Almeida - x16126602
# BSc (Honours) in Computing - IoT Stream
# GrovePi + Grove Ultrasonic Ranger + Relay Pin


from grovepi import *

# Connect the Grove Ultrasonic Ranger to digital port D4
# SIG,NC,VCC,GND
# Connect the Grove Relay Pin to the digital port D2

ultrasonic_ranger = 4
Relay_pin = 2#NECESSARIO?

pinMode(Relay_pin,"OUTPUT")


time_to_sleep       = 1       # The main loop runs every 1.5 seconds

while True:
    try:

        # Read distance value from Ultrasonic
        distant = ultrasonicRead(ultrasonic_ranger)

        #print('empty')
        if distant > 30:
            print('______________________________')
            print('The bin is empty.')
            print(distant,'cm available')
            digitalWrite(Relay_pin,1)

        #print('empty')
        if distant >= 15 and distant <= 20:
            print('______________________________')
            print('The bin is half-full.')
            print(distant,'cm available')
            digitalWrite(Relay_pin,1)
        
        if distant >= 20 and distant < 10:
            print('______________________________')
            print('Almost full')
            print(distant,'cm available')
            digitalWrite(Relay_pin,1)

        #print('The bin is full. Please collect it as there is only ',distant,'cm available')
        if distant <= 10:
            print('______________________________')
            print('The bin is full. Please collect it as there is only ',distant,'cm available')
            digitalWrite(Relay_pin,1)

        else:
            digitalWrite(Relay_pin,0)

    except TypeError:
        print("Error")
    except IOError:
        print("Error")


    #Slow down the loop
    time.sleep(time_to_sleep)







        # Read distance value from Ultrasonic
        #distant = ultrasonicRead(ultrasonic_ranger)

	#print(distant,'cm - empty')


        #if distant > 25:
            #digitalWrite(Relay_pin,1)


        #print(distant,'cm')

	#print('The bin is full. Please collect it as there is only ', distant,'cm available')
        #elif distant <= 10:
            #digitalWrite(Relay_pin,1)
	    
        #else:
            #digitalWrite(Relay_pin,0)













