#!/bin/bash

sudo wget -qP /etc/apt/sources.list.d/ https://www.trillian.im/get/linux/2.0/apt/trillian.list
wget -qO - https://www.trillian.im/get/linux/2.0/apt/trillian.key | sudo apt-key add -
sudo apt-get update
sudo apt-get install trillian
