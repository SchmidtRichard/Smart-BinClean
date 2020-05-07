#Richard Schmidt de Almeida
#National College of Ireland
#Bsc (Honours) in Computing - IoT Stream
#May 2020
#Smart BinClean Project
#SmartBinClean.py


# Connect the Grove Ultrasonic Ranger to digital port D4
# SIG,NC,VCC,GND
# Connect the Grove Relay Pin to the digital port D2

#Relay_pin = 2#NECESSARIO?

#pinMode(Relay_pin,"OUTPUT")

from grovepi import *
import requests as req         #import requests to be used for webqueries
import time

size1=[30] #eg. for trash size 30cm
size2=[60] #eg. for trash size 60cm

trash=[] #create an empty array, where we'll add all the trash with their sizes

trash1 = [1,2] #reprezented by trash[0]=no of the  trash, trash[1]=pin number where ultrasonic connects to Raspberry Pi
trash1.extend(size1)  #this will makes your trash1 to include size1, at the end trash = [1,2,30]
print ('trash1: ', trash1)

trash.extend(trash1)

trash2 = [2,4]
trash2.extend(size2) #you add the size of associated trash no 2.
print ('\n')
print ('trash2: ', trash2)

###########################

trash.extend(trash2)  #comtrashe previous trash (which in this stage is trash no 2) to trash no 1 in a single array

###########################
trash3 = [3,7]
trash3.extend(size1)
print ('\n')
print ('trash3: ', trash3)

trash.extend(trash3) #comtrashe previous trash (which in this stage is trash no 3) to trash (which contain trash 1 + trash 2) in a single array

trash4 = [4,8]
trash4.extend(size1)
print ('\n')
print ('trash4: ', trash4)

trash.extend(trash4)


def judge(distant,trash_id,size):
	#print('Measurement for %d pin'% trash_id)
	#Here we take the full size of the trash and set it as empty eg. for size1, measurement > 30
	if distant >= size: 
		print('______________________________')
		print('The trash %d is empty.' % trash_id)
		print(distant,'cm available')
		
		#IP needs to be udpated by the IP address of the network been used on the setup - not included here for security reasons
		resp=req.get("http://IP/admin/update_with_raspberry.php?id=%d&image=empty" % trash_id)

	#Half to full status,once there is something in the trash
	if distant <= size:
		# eg. for size1, measurement < 10
		if distant <= (size/3):
			print('______________________________')
			print('The trash %d is full. Please collect it as there is only '% trash_id ,distant,'cm available')
			
			#IP needs to be udpated by the IP address of the network been used on the setup - not included here for security reasons
			resp=req.get("http://IP/admin/update_with_raspberry.php?id=%d&image=full" % trash_id)
		else: 
		# eg. for size1, measurement is between 11 and 29
			print('______________________________')
			print('The trash %d is half-full.'% trash_id)
			print(distant,'cm available')
			
			#IP needs to be udpated by the IP address of the network been used on the setup - not included here for security reasons
			resp=req.get("IP/admin/update_with_raspberry.php?id=%d&image=half" % trash_id)


while True:
	for i in range(0,len(trash),3): #3 reprezents the step index like i:0,3,6,9,12
		distant = ultrasonicRead(trash[i+1])#Gest pin of the ultrasonic, whic
		judge(distant,trash[i],trash[i+2]) #bin id -> trash[i] size of the bin by id -> trash[i+2])
		
		#Slow down the loop
		time.sleep(3)	


