<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
$club_id = $_GET['id'];
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
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['title'], $_POST['content'])) {
	// Could not get the data that should have been sent.
	exit('The post needs a title and content!');
}

// Make sure the submitted registration values are not empty.
if (empty($_POST['title'] || $_POST['content'])) {
	// One or more values are empty.
	exit('The post needs a title and content');
}

if ($stmt = $con->prepare('SELECT postID FROM posts_table WHERE clubID = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc)
	$stmt->bind_param('i', $club_id);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if there are more than three posts.
	if ($stmt->num_rows >= 3) {
		$stmt->execute();
		$posts = $stmt->get_result();
		$row = mysqli_fetch_array($posts);
		$stmt->free_result();
		if ($stmt = $con->prepare('DELETE FROM posts_table WHERE postID = ?')) {
			$stmt->bind_param('i', $row['postID']);
			$stmt->execute();
			$stmt->free_result();
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo 'Could not prepare statement!';
		}
	}
} else {
	// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
	echo 'Could not prepare statement!';
}
	
if ($stmt = $con->prepare('INSERT INTO posts_table (clubID, title, content) VALUES (?, ?, ?)')) {
			$stmt->bind_param('iss', $club_id, $_POST['title'], $_POST['content']);
			$stmt->execute();
			$stmt->free_result();
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo 'Could not prepare statement!';
		}
header('Location: club-profile.php?id='.$club_id);
?>