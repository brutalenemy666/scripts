#!/bin/bash

echo "------VAGRANT------"

# expecting structure:
# $HOME/vagrant/server
# $HOME/vagrant/box_1
# $HOME/vagrant/....
VAGRANT_DIRECTORY="$HOME/vagrant"

echo "Enter box name:"
read box_name
while [ -z "$box_name" ]; do
	echo "Please enter a box name (ex: server):"
	read box_name
done

VAGRANT_DIRECTORY="$VAGRANT_DIRECTORY/$box_name"

echo "Entering in the Vagrant directory $VAGRANT_DIRECTORY"

cd $VAGRANT_DIRECTORY

echo "Awaiting vagrant command:"

read vcommand

echo "==> Executing: $vcommand"

$vcommand

echo "--------END--------"
