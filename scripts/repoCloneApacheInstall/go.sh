#!/bin/bash

# below cron support
# rem when want to test it
#cd /home/peter/proj/swig/repoCloneApacheInstall/

if [ ! -f ./passwordFile.sh ] ;
then # no password file
	exit 1;
fi

. ./passwordFile.sh

# passwordFile.sh content:
#echo $gitUserName
#echo $gitUserPass
#echo $mysqlUser
#echo $mysqlPass


date=`date +%Y%m%d%H%M%S`

dbName="swigDb$date"
dbUser="swigUser$date"
dbPass="swigPass$date"

./clean.sh
./getFromRepo.sh ${gitUserName} ${gitUserPass}      								|| exit 1;
cp -f ./swigwww/.env.example ./swigwww/.env									|| exit 1;
./confProjDbAccess.sh ./swigwww/.env "${dbName}" "${dbUser}" "${dbPass}"  					|| exit 1;
cd ./db/; ./createDbAndUser.sh "${dbName}" "${dbUser}" "${dbPass}" "${mysqlUser}" "${mysqlPass}"; cd ..  	|| exit 1;
./switchBranch.sh												|| exit 1;
./installProject.sh ./swigwww/											|| exit 1;
./copyToPublicHtml.sh ${date} ${sysUserName}									|| exit 1;

