#Richard Schmidt de Almeida
#National College of Ireland
#Bsc (Honours) in Computing - IoT Stream
#Software Project - May 2020
#Smart BinClean Project
#SmartBinClean.py

#SmartBinClean.py to be executed in a RaspberryPi with a GrovePi and Ultrasonic Sensor
#All the other files to be saved on a folder in the XAMPP directory and have Apache and MySQL started
#MySQL to be imported to phpmyadmin in order to have the same setup on the DB side as well

#Connect the Grove Ultrasonic Ranger to digital ports D2, D4, D7 and D8

from grovepi import *
import requests as req	#Import requests to be used for webqueries
import time

#Create new array for new bin(s) with diferent size(s) e.g. size3 = [90] for a bin with 90cm
size1=[30] 				#Set 30cm size1 for the bin
size2=[60] 				#Set 60cm size1 for the bin

trash=[] #Create an empty array, where we'll add all the bins with their sizes, bin id and port number

#####################################################################################################

trash1 = [1,2]			#Represents trash[1] = id of the bin in the system, trash[2] = pin number where ultrasonic connects to the GrovePi
trash1.extend(size1)	#Include size1 at the end of the trash1=[] array example trash = [1, 2, 30] <--- bin id, port number, size of the bin
print ('trash1: ', trash1)

trash.extend(trash1) 	#Include trash1 to the trash array

#####################################################################################################

trash2 = [2,4]			#Represents trash[2] = id of the bin in the system, trash[4] = pin number where ultrasonic connects to the GrovePi
trash2.extend(size2)	#Include size2 at the end of the trash1=[] array example trash = [2, 4, 60] <--- bin id, port number, size of the bin
print ('\n')
print ('trash2: ', trash2)

trash.extend(trash2)  	#Include trash2 to the trash array where already contains trash1

#####################################################################################################

trash3 = [3,7]			#Represents trash[3] = id of the bin in the system, trash[7] = pin number where ultrasonic connects to the GrovePi
trash3.extend(size1)	#Include size1 at the end of the trash3=[] array example trash = [3, 7, 30] <--- bin id, port number, size of the bin
print ('\n')
print ('trash3: ', trash3)

trash.extend(trash3) 	#Include trash3 to the trash array where already contains trash1, trash2

#####################################################################################################

trash4 = [4,8]			#Represents trash[4] = id of the bin in the system, trash[8] = pin number where ultrasonic connects to the GrovePi
trash4.extend(size1)	#Include size1 at the end of the trash4=[] array example trash = [4, 8, 30] <--- bin id, port number, size of the bin
print ('\n')
print ('trash4: ', trash4)

trash.extend(trash4)	#Include trash4 to the trash array where already contains trash1, trash2, trash3

#####################################################################################################

#Function to get the readings of all the bins and use request for webqueries, it judges what is the level of rubbish inside each bin
def judge(distant,trash_id,size):
		
	#Here we take the full size of the trash and set it as empty eg. for size1, measurement > 30
	if distant >= size: 
		print('______________________________')
		print('The trash %d is empty.' % trash_id)
		print(distant,'cm available')
		
		#IP must be replaced with the IP of the network the system is setup, removed my one for obvious security reasons
		resp=req.get("http://IP/admin/update_with_raspberry.php?id=%d&image=empty" % trash_id)

	#Half to full status,once there is something in the trash
	if distant <= size:
		#eg. for size1, measurement < 10 - full
		if distant <= (size/3):
			print('______________________________')
			print('The trash %d is full. Please collect it as there is only '% trash_id ,distant,'cm available')
			
			#IP must be replaced with the IP of the network the system is setup, removed my one for obvious security reasons
			resp=req.get("http://IP/admin/update_with_raspberry.php?id=%d&image=full" % trash_id)
		else: 
			#eg. for size1, measurement is between 11 and 29 - half-full
			print('______________________________')
			print('The trash %d is half-full.'% trash_id)
			print(distant,'cm available')
			
			#IP must be replaced with the IP of the network the system is setup, removed my one for obvious security reasons
			resp=req.get("http://IP/admin/update_with_raspberry.php?id=%d&image=half" % trash_id)

#Keeps the code running to get readings
while True:
	for i in range(0,len(trash),3): #3 represents the step index like i:0,3,6,9,12 as each trash1,2,3,4 array have 3 indexes in each
		
		#distant = ultrasonic Read ---> calls a function from grovepi library, which converts the measured signals (sent and received) into readable distance measured in centimeters
		distant = ultrasonicRead(trash[i+1])
		
		#judge ---> calls a function in the python program, that judges the state of the bins and send the distance measured, bin id, and size of the bin
		judge(distant,trash[i],trash[i+2])
		
		#Slow down the loop
		time.sleep(3)	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		