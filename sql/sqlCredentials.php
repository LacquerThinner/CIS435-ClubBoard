<?php
$DATABASE_HOST = '141.215.80.154';
$DATABASE_USER = 'group6';
$DATABASE_PASS = 'DDFLa@mq7SR';
$DATABASE_NAME = 'group6_db';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
?>