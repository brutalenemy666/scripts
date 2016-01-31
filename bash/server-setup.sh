#!/bin/bash

echo "#------------------------------"
echo "Adding ppa repositories for Apache2 and PHP7"
echo "#------------------------------"
sudo add-apt-repository ppa:ondrej/apache2
sudo add-apt-repository ppa:ondrej/php-7.0
sudo apt-get update

echo "#------------------------------"
echo "Installing apache2"
echo "#------------------------------"
sudo apt-get insall apache2

echo "#------------------------------"
echo "MySQL"
echo "#------------------------------"
sudo apt-get install mysql-server --fix-missing
# mysql -uroot -hlocalhost -p

echo "#------------------------------"
echo "Installing PHP7"
echo "#------------------------------"
sudo apt-get install python-software-properties
sudo apt-get install php7.0 php7.0-common php7.0-cgi php7.0-fpm php7.0-mysql

echo "#------------------------------"
echo "PHP7 available modules"
echo "#------------------------------"
sudo apt-cache search php7-*

echo "#------------------------------"
echo "Installing php7/apache requirements"
echo "#------------------------------"
sudo apt-get install libapache2-mod-php7.0 php7.0-mysql php7.0-curl php7.0-json

echo "#------------------------------"
echo "Installing composer"
echo "#------------------------------"
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

echo "#------------------------------"
echo "Install Laravel"
echo "#------------------------------"
composer global require "laravel/installer"
