#!/bin/bash

echo "1. Connect the phone device"
echo "2. Enable the USB debuggin option"
read -p "3. Press enter"
adb start-server
echo "4. Allow the USB debugging on the phone"
read -p "5. Enter a backup filename and press enter. Spaces are not allowed. `echo $'\n> '`" BACKUPFILENAME
adb backup -apk -shared -all -f "$BACKUPFILENAME.adb"
