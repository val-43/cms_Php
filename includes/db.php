<?php


$db['db_user'] = "root";
$db['db_passwd'] = "";
$db['db_database'] = "cms";
$db['db_host'] = "localhost";

foreach($db as $key => $value){
    define(strtoupper($key), $value);
}

$connection = mysqli_connect(DB_HOST,DB_USER,DB_PASSWD,DB_DATABASE);

if(!$connection){
    echo "Not connected";
}

