<?php

$server = 'localhost';
$username = 'root';
$password = '';
$database = 'gnbdata';
$con = mysqli_connect($server, $username, $password, $database);
if (!$con) {
    die('error');
}
else{
    echo 'connected';
}
?>