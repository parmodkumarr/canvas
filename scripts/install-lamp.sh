#!/bin/bash
# Run by ~$ sudo ./lamp.ch #
############################
if [ "`lsb_release -is`" == "Ubuntu" ] || [ "`lsb_release -is`" == "Debian" ]
then
	### Installing LAMP (Apache, MySQL and PHP) ###
	sudo apt-get update;
    	sudo apt-get -y install lamp-server^;
	### PHP modules ###
	sudo apt install php7.0-cli php7.0-xml php7.0-mysql;
	####################################################
    	sudo chmod 755 -R /var/www/;
    	sudo printf "<?php\nphpinfo();\n?>" > /var/www/html/index.php;
    	sudo a2enmod rewrite;
    	sudo service apache2 restart;
	### Installing composer and Git ###
	sudo apt-get install curl php-cli php-mbstring git unzip;
	cd ~;
	curl -sS https://getcomposer.org/installer -o composer-setup.php;
	sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer;
	### Going to apache directory to clone project files from Git ###
	cd ~;
	cd /var/www;
	### Cloning project from Git ###
	git clone https://gitlab.com/biegus/finances.git;
	cd /var/www/finances;
	git checkout dev;
	### Moving project to default Apache dir ###
	cd ~;
	sudo chmod 755 -R /var/www/;
	rm -rf /var/www/html;
	cd /var/www;
	mv finances html;
	sudo service apache2 restart;
	### Updating dependencies ###
	cd /var/www/html;
	composer update;
	sudo chmod 777 -R /var/www/;
else
    echo "Unsupported Operating System";
fi

### In general, installation completed ###
