<?php

$configPath = _DIR_ . "/config.php";

if (file_exists($configPath)) {
    // Dev Station
    include $configPath;
    $host = $db_host;
	$port = $db_port;
	$socket="";
    $password = $db_password;
    $name = $db_name;
	$user = $db_user;
} else {
    // FLY.IO
	$host=getenv("DB_HOST");
	$port=getenv("DB_PORT");
	$socket="";
	$user=getenv("DB_USER");
	$password=getenv("DB_PASS");; 
	$dbname=getenv("DB_NAME");
}

$conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$conn->close();
 
?>