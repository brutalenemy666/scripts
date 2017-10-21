#!/bin/bash

# usage in other sh file
# ./ask-for-sudo.sh $0

if [[ $UID != 0 ]]; then
	echo "Please run this script with sudo:"
	# echo "sudo $0 $*"
	echo "sudo $*"
	exit
fi
