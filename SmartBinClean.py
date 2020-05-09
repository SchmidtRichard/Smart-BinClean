#Richard Schmidt de Almeida
#National College of Ireland
#Bsc (Honours) in Computing - IoT Stream
#May 2020
#Smart BinClean Project
#SmartBinClean.py

#Connect the Grove Ultrasonic Ranger to digital ports D2, D4, D7 and D8

from grovepi import *
import requests as req	#import requests to be used for webqueries
import time

size1=[34] #Set 34cm size1 for the bin
size2=[60] #Set 60cm size1 for the bin

trash=[] #Create an empty array, where we'll add all the bins with their sizes, eg. for 2 bins: trash=[1,2,34,2,4,60]
																						 #i from loop  0      3

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
	
	#We take the measure and compare if it is between 0 and 1/3 of the size of the bin | as we look at the been from the buttom to top
	#Here we take the full size of the trash and set it as empty eg. for size1, measurement between 22 and 34
	if ((2*size/3)<=distant) and (distant <= size):
		print('______________________________')
		print('The trash %d is empty.' % trash_id)
		print(distant,'cm available')
		resp=req.get("IP/admin/update_with_raspberry.php?id=%d&image=empty" % trash_id)
		#IP must be replaced with the IP of the network the system is setup, removed my one for obvious security reasons

	#We take the measure and compare to be between 1/3 and 2/3 of the size of the bin
	#for size 1 eg. if the measurement is between 11 and 22
	if ((size/3)<distant) and (distant<(2*size/3)): # as we measure from the top to buttom of the bin
			print('______________________________')
			print('The trash %d is half-full.'% trash_id)
			print(distant,'cm available')
			resp=req.get("IP/admin/update_with_raspberry.php?id=%d&image=half" % trash_id)
			#IP must be replaced with the IP of the network the system is setup, removed my one for obvious security reasons
	
	#We take the measure and compare to be between 2/3 and 3/3 of the size of the bin
	#for size 1 eg. if the measurement is between 0 and 11
	if (0<=distant) and (distant<=(size/3)): # as we measure from the top to buttom of the bin
			print('______________________________')
			print('The trash %d is full. Please collect it as there is only '% trash_id ,distant,'cm available')
			resp=req.get("IP/admin/update_with_raspberry.php?id=%d&image=full" % trash_id)
			#IP must be replaced with the IP of the network the system is setup, removed my one for obvious security reasons

#Keeps the code running to get readings
while True:
	
	for i in range(0,len(trash),3): #3 represents the step index like i:0,3,6,9,12 as each trash1,2,3,4 array have 3 indexes in each

		#distant = ultrasonic Read ---> calls a function from grovepi library, which converts the measured signals (sent and received) into readable distance measured in centimeters
		distant = ultrasonicRead(trash[i+1])
		
		#Judge ---> calls a function in the python program, that judge if the state of the bin and send the distance measured, bin id, and size of the bin
		judge(distant,trash[i],trash[i+2])#measurement, the bin id, the size of the bin goes into the def judge parameters
	
	#Slow down the loop
	time.sleep(3)	






