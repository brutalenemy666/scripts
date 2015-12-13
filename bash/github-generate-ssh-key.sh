#!/bin/bash

echo "------Generating GitHub SSH keys------"

echo "# Current Keys"

ls -al ~/.ssh

echo "Enter your guthub email address:"
read email_address

# Creates a new ssh key, using the provided email as a label
ssh-keygen -t rsa -b 4096 -C $email_address

# start the ssh-agent in the background
echo "SSH-Agent:"
eval "$(ssh-agent -s)"

echo "Enter the name of the private key from above:"
read private_key_name
ssh-add ~/.ssh/$private_key_name

echo "Copy the SSH key to your clipboard."
echo "Your SSH key is:"
cat ~/.ssh/$private_key_name

echo "-------------------END----------------"
