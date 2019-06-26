#!/bin/bash

# check if php-cli is installed
programName="php-cli"
composerInstallDir="./bin"


if [ -f $composerInstallDir/composer ] ;
then
	echo "Composer installed: [$composerInstallDir/composer]";
	exit 0;
fi


if [ ! aa"`apt-cache policy "$programName" | grep "Installed" | grep "none"`" = aa"" ] ;
then # no $programName installed
	echo "NOT installed package: $programName";

	while true; do
		read -p "Do you wish to install $programName?: " yn
		case $yn in
			[Yy]* ) sudo apt-get install $programName; break;;
			[Nn]* ) exit;;
			* ) echo "Please answer yes or no.";;
		esac
	done
fi

if [ ! -f ./composerSetup.php ] ;
then
	php -r "copy('https://getcomposer.org/installer', './composer-setup.php');"
fi

php -r "if (hash_file('SHA384', './composer-setup.php') === '669656bab3166a7aff8a7506b8cb2d1c292f042046c5a994c43155c0be6190fa0355160742ab2e1c88d40d5be660b410') { echo 'Installer verified. Check "https://composer.github.io/pubkeys.html"' for current signature.; } else { echo 'Installer corrupt'; unlink('./composer-setup.php'); } echo PHP_EOL;"

if [ ! -f ${composerInstallDir} ] ;
then
	mkdir -p $composerInstallDir
fi

php ./composer-setup.php --install-dir=./bin --filename=composer

