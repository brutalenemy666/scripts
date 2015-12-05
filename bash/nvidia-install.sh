#!/bin/bash

echo "---------Installing Latest Nvidia---------"

# install the latest version
sudo apt-get install nvidia-current

echo "---------Verify the installation----------"

# verify
echo "Verifying if the NVidia is installed."
lspci -vnn | grep -i VGA -A 12

echo "---------"

echo "The OpenGL renderer string should be anything other than \"MESA\". Then it indicates that the hardware drivers are being used for hardware acceleration."
echo "If the next command fails, run: "
echo "1. sudo apt-get install mesa-utils"
echo "2. glxinfo | grep OpenGL | grep renderer"
glxinfo | grep OpenGL | grep renderer

echo "------------------END---------------------"
