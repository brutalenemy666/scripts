# apache
sudo add-apt-repository ppa:ondrej/apache2
sudo apt-get update
sudo apt-get insall apache2

# install mysql
sudo apt-get install mysql-server --fix-missing
# mysql -uroot -hlocalhost -p

# php 7
sudo apt-get install python-software-properties
sudo add-apt-repository ppa:ondrej/php-7.0
sudo apt-get update
sudo apt-get install php7.0 php7.0-common php7.0-cgi php7.0-fpm php7.0-mysql

# list available modules
sudo apt-cache search php7-*

# install some requirements
sudo apt-get install libapache2-mod-php7.0 php7.0-mysql php7.0-curl php7.0-json
