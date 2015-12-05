#!/bin/bash

# ask for sudo
echo "Forwarding Vagrant ports:"

MACHINE_IP_ADDRESS="192.168.2.95"
LOCAL_OUTPUT=(
	"80:8080"
	"443:8443"
	"22:2222"
	"21:2221"
)
INCOMING_TRAFIC=(
	"80:8080"
	"443:8443"
)

for i in "${!LOCAL_OUTPUT[@]}"; do
	value=${LOCAL_OUTPUT[i]}

	# split into an array
	IFS=':' read -r -a parts <<< "$value"

	echo "    Forwarding the local OUTPUT from port ${parts[0]} to port ${parts[1]}"
	iptables -t nat -A OUTPUT -o lo -p tcp --dport ${parts[0]} -j REDIRECT --to-port ${parts[1]}
done

for i in "${!INCOMING_TRAFIC[@]}"; do
	value=${INCOMING_TRAFIC[i]}

	# split into an array
	IFS=':' read -r -a parts <<< "$value"

	echo "    PREROUTING the incoming traffic for IP $MACHINE_IP_ADDRESS from port ${parts[0]} to port ${parts[1]}"
	iptables -t nat -I PREROUTING --src 0/0 --dst $MACHINE_IP_ADDRESS -p tcp --dport ${parts[0]} -j REDIRECT --to-ports ${parts[1]}
done

echo "END Forwarding:"
