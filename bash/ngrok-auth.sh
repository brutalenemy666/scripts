#!/bin/bash

echo "Enter your token:"
read authtoken

echo "Enter subdomain:"
read subdomain

echo "Enter port:"
read port

ngrok -authtoken $authtoken -subdomain=$subdomain $port
