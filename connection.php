<?php

$server   = "localhost";
$username = "root"; 
$password = ""; 
$db		  = "inovo";


// Creating a connection
$conn = mysqli_connect($server, $username, $password, $db);


// Checking connection
if (!$conn) {
	die("Connection failed: " . mysqli_connect_error() );

}

?>	