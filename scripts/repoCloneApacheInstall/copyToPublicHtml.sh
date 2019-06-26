#!/bin/bash

#shopt -s extglob

if [ $# -lt 1 ] ;
then
	echo "Usage: $0 date userNameToCopyTo"
	echo "'date' is used to create names for: directory"
	exit 1;
fi

date=$1
homeUser=$2

repoDir="./swigwww/"
destDir="/home/${homeUser}/public_html/swigwww/${date}/"

#test -d "$destDir" || mkdir -p "$destDir" && cp -ar !(${repoDir}/scripts ${repoDir}/.git) i${repoDir}/* $destDir && cp -ar ./config.php $destDir

test -d "$destDir" || mkdir -p "$destDir" && rsync -a --exclude=.htaccess --exclude=scripts --exclude='.git' ${repoDir} ${destDir} && cp -ar ./config.php $destDir
#cp ${repoDir}/.env ${destDir}
#cp -arv ${repoDir} ${destDir}

# setting permissions
chmod -R 777 ${destDir}

