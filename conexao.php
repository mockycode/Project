<?php
$host="mysql-3babbcf6-ibiapinoigor-305e.i.aivencloud.com";
$port=14624;
$socket="";
$user="avnadmin";
$password= ""; 
$dbname="mockycode";

$conn = new mysqli($host, $user, $password, $dbname, $port, $socket)
	or die ('Could not connect to the database server' . mysqli_connect_error());

//$conn->close();
 
?>