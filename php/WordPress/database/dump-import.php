<?php
ini_set('max_execution_time', 300);

require_once('wp-config.php');
$host = DB_HOST;
$user = DB_USER;
$pass = DB_PASSWORD;
$db_name = DB_NAME;
$filename = 'dump.sql';

if (file_exists($filename . '.zip')) {
	system("unzip -u {$filename}.zip $filename");
}

echo "begin<br />\n";
system("cat {$filename} | mysql -h {$host} -u {$user} --password=" . escapeshellarg($pass) . " {$db_name} 2>&1");
echo "end<br />\n";

if (file_exists($filename . '.zip')) {
	system("rm $filename");
}
