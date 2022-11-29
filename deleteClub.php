<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$club_id = $_GET['id'];
//connect to the database
include('sql/sqlCredentials.php');

if ($stmt = $con->prepare('DELETE FROM club_table WHERE clubID = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('i', $club_id);
	$stmt->execute();
}
else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
header('Location: clubs-1');
?>