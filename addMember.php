<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
// Change this to your connection info.
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'group6_db';
// Try and connect using the info above.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	// If there is an error with the connection, stop the script and display the error.
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

$club_id = $_GET['id'];
if ($stmt = $con->prepare('INSERT INTO membership_table (userID, clubID, admin) VALUES (?, ?, ?)')) {
	$admin = false;
	$stmt->bind_param('ssi', $_SESSION['id'], $club_id, $admin);
	$stmt->execute();
	$stmt->free_result();
	header('Location: club-profile.php?id='.$club_id);
}

?>