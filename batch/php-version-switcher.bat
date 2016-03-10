@echo off

echo ----------------------
echo  PHP Version Switcher
echo ----------------------

REM set apache_service to the httpd service path of Apache
REM set apache_conf to apache's conf directory
REM place a httpd.conf.php5 and httpd.conf.php7 files in the conf directory

SET apache_service="C:\Apache24\bin\httpd"
SET apache_conf="C:\Apache24\conf\"

set /P version=Enter version (5 or 7):

IF %version% EQU 5 GOTO switch
IF %version% EQU 7 GOTO switch

exit

:switch
%apache_service% -k stop
del /F "%apache_conf%httpd.conf"
copy "%apache_conf%httpd.conf.php%version%" "%apache_conf%httpd.conf"
%apache_service% -k start
echo Switched to PHP %version%
timeout /t 3 /nobreak
:end