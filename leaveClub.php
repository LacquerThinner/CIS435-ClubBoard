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
if ($stmt = $con->prepare('DELETE FROM membership_table WHERE clubID = ? && userID = ?')) {
	$admin = false;
	$stmt->bind_param('ii', $club_id, $_SESSION['id']);
	$stmt->execute();
	$stmt->free_result();
	header('Location: profile.php');
}

?>