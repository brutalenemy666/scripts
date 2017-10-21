<?php
require_once('../wp-config.php');
global $table_prefix;
$host = escapeshellarg(DB_HOST);
$user = escapeshellarg(DB_USER);
$pass = escapeshellarg(DB_PASSWORD);
$db_name = escapeshellarg(DB_NAME);
$filename = escapeshellarg('dump.sql');

echo "begin<br />\n";
system("mysqldump -h $host -u $user -p{$pass} $db_name \$(mysql -u $user -p{$pass} -D $db_name -Bse \"show tables like '{$table_prefix}%'\") > $filename 2>&1"); // 2>&1
echo "end<br />\n";
