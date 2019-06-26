#!/bin/bash

if [ $# -lt 3 ] ;
then
	echo "Usage: $0 fileName dbName userName userPass"
	exit 1;
fi

fileName=$1
dbName=$2
userName=$3
userPass=$4

#DB_HOST
#DB_DATABASE=
#DB_USERNAME=
#DB_PASSWORD=

sed --in-place="-back" -e "s/DB_HOST\=.*/DB_HOST\=localhost/g" -e "s/DB_DATABASE\=.*/DB_DATABASE\=$dbName/g" -e "s/DB_USERNAME\=.*/DB_USERNAME\=${userName}/g" -e "s/DB_PASSWORD\=.*/DB_PASSWORD\=${userPass}/g" ${fileName}

exit $?

