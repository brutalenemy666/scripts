#!/bin/bash

pattern=^[0-9]+$

while ! [[ $port_source =~ $pattern ]]; do
    echo "Enter source port."
    read port_source
done

while ! [[ $port_target =~ $pattern ]]; do
    echo "Enter target port."
    read port_target
done

sudo iptables -t nat -A OUTPUT -o lo -p tcp --dport $port_source -j REDIRECT --to-port $port_target

echo "The traffic from port $port_source to port $port_target is now forwarded."
