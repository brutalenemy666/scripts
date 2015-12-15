#!/bin/bash

UBUNTU_PARTITION="/dev/sda1"

# comes from /sda
GRUB_DRIVE="/dev/sda"

# Mount the partition your Ubuntu Installation is on.
sudo mount $UBUNTU_PARTITION /mnt

# bind the directories that grub needs access to to detect other operating systems

sudo mount --bind /dev /mnt/dev
sudo mount --bind /dev/pts /mnt/dev/pts
sudo mount --bind /proc /mnt/proc
sudo mount --bind /sys /mnt/sys

# jump into mnt using chroot.
sudo chroot /mnt

# install grub
grub-install $GRUB_DRIVE

# check grub installation
grub-install --recheck $GRUB_DRIVE

# update grub
update-grub

# exit the chrooted system and unmount everything.
exit
sudo umount /mnt/sys
sudo umount /mnt/proc
sudo umount /mnt/dev/pts
sudo umount /mnt/dev
sudo umount /mnt

echo "Grub installation has been completed."
echo "Remove your LIVE CD and press any key to reboot."
echo "If you have any other OS installed execute the following command to update the GUB after the restart."
echo ">> sudo update-grub"

# wait for the user to read the message and reboot when ready
read awaiting_user_input

# reboot the system
sudo reboot
