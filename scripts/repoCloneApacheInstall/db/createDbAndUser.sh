#!/bin/bash

if [ $# -lt 5 ] ;
then
	echo "usage $0 databaseName userName userPassword mySqlUserName mySqlPass"
	exit 1;
fi

databaseName=$1
userName=$2
userPass=$3
sqlSkeletonFile="dbPriviledges.sql-skeleton"
sqlOutputFile="dbDef.sql"
mySqlUserName=$4
mySqlPass=$5

sed -e "s/___DaTaBaSe___NaMe___/${databaseName}/g" -e "s/___UsEr___NaMe___/${userName}/g" -e "s/___PaSsWoRd___/${userPass}/g" ${sqlSkeletonFile} > ${sqlOutputFile}

if [ ! $? -eq 0 ] ;
then # fail
	echo "sed problem"; # debug purpose
	exit 1;
fi

#mysql -s -s -s -u${mySqlUserName} -p${mySqlPass} 2>&1 < ./${sqlOutputFile} 2>&1 | grep -v "Warn"
#mysql -s -s -s -u${mySqlUserName} -p${mySqlPass} 2>&1 > /dev/null < ./${sqlOutputFile} 2>&1 > /dev null

# redirecting to /dev/null because of warnings from mysql
mysql -u${mySqlUserName} -p${mySqlPass} 2>&1 > /dev/null < ./${sqlOutputFile} 2>&1 > /dev/null

if [ ! $? -eq 0 ] ;
then # fail
#	echo "mysql problem"; # debug purpose
	exit 1;
fi


