@echo off

REM forwards the traffic from port to port
REM netsh interface portproxy add v4tov4 listenport=80 connectport=8080 connectaddress=127.0.0.1
REM netsh interface portproxy add v4tov4 listenport=443 connectport=8443 connectaddress=127.0.0.1

SET /P sourse=Enter source port (ex. 80):
SET /P target=Enter target port (ex. 8080):

netsh interface portproxy add v4tov4 listenport=%source% connectport=%target% connectaddress=127.0.0.1
