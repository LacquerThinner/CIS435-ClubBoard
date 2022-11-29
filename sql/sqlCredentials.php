<?php
$DATABASE_HOST = '141.215.80.154';
$DATABASE_USER = 'group6';
$DATABASE_PASS = 'DDFLa@mq7SR';
$DATABASE_NAME = 'group6_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>