#!/bin/bash

if [ $# -lt 1 ] ;
then
	echo "Usage: $0 repoDir"
	exit 1;
fi

repoDir=$1

cd ${repoDir}
composer install
composer update
php artisan key:generate
php artisan migrate
php artisan migrate:refresh --seed

exit 0;

