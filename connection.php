<?php

function Connect()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbname = "ezy_rentals";

	//Create Connection
	$conn =  mysqli_connect($dbhost, $dbuser,'',$dbname) or die($conn->connect_error);

	return $conn;
}
?>