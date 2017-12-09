#!/bin/bash
# source: https://askubuntu.com/questions/767504/permissions-problems-with-var-www-html-and-my-own-home-directory-for-a-website

echo "Enter a valid server root directory (ex. /var/www/html):"
read server_root

echo "Enter owner user (ex. myusername, nginx, www-data, root, etc.):"
read owner_user

echo "Enter owner group (ex. www-data):"
read owner_group

echo "Set owner group..."
sudo chgrp -R $owner_group $server_root
sudo find $server_root -type d -exec chmod g+rx {} +
sudo find $server_root -type f -exec chmod g+r {} +

echo "Give the owner user read/write privileges to the folders and the files..."
sudo chown -R $owner_user $server_root
sudo find $server_root -type d -exec chmod u+rwx {} +
sudo find $server_root -type f -exec chmod u+rw {} +

echo "Make sure every new file after this is created with $owner_group as the $owner_user user..."
sudo find $server_root -type d -exec chmod g+s {} +

echo "Done"

printf "\n"
