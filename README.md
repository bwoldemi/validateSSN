Objective
	The objective of this project is to develop an API which validates the Finnish Social security number(SSN). 

SSN format
	In Finland the personal identity code (social security number) has a DDMMYYCZZZQ format. DDMMYY is person date of  birth. C is the century identification sign (+ for the 19th century, - for the 20th and A for the 21st), ZZZ is the personal identification number and Q is a checksum character. The checksum character is calculated thus: Take the birth date and person number, and join them into one 9-digit number x. Let n = x mod 31. Then the checksum letter is the (n+1)th character from this string: "0123456789ABCDEFHJKLMNPRSTUVWXY".

Test cases 
	• Should Contain valid 11 digits (DDMMYYCZZZQ)
	• Should contain a valid Century identifier (-, A or +)
	• Should contain a valid date of birth 
	• Should contain a valid personal identification number (ZZZ)
	• Should contain a valid checksum character 

Server Deployment  
	• The rest API can be deployed in any php web-server can be accessed through get request. For example, you_server_name/ssnValidate.php?ssn=200383-203F

Accessing API
	The API can be accessed using Get request from command line interface (CLI) such as cURL, or with any programing language with the following parameters  

	Content-type text/pain
	?ssn=DDMMYYCZZZQ 

Response 
	• The rest API responses true with http status 200 for valid SSN, and false with http 200 status for invalid SSN. 

