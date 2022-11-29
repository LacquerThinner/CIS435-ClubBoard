<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
//connect to the database
include('sql/sqlCredentials.php');

$club_id = $_GET['id'];
if ($stmt = $con->prepare('INSERT INTO membership_table (userID, clubID, admin) VALUES (?, ?, ?)')) {
	$admin = false;
	$stmt->bind_param('ssi', $_SESSION['id'], $club_id, $admin);
	$stmt->execute();
	$stmt->free_result();
	header('Location: club-profile-'.$club_id);
}

?>