#!/bin/bash

if [ $# -lt 2 ] ;
then
	echo "Usage: $0 userName userPass"
	exit 1;
fi

username=$1
password=$2

git clone https://$username:$password@repo.embeddedsoft.eu/repos/git/swigwww.git

exit $?
