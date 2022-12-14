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
// Now we check if the data was submitted, isset() function will check if the data exists.
if (!isset($_POST['club-name'], $_POST['bio'], $_POST['category'], $_POST['contact'], $_FILES['img']['name'])) {
	// Could not get the data that should have been sent.
	exit('Please complete the registration form!');
}

// Make sure the submitted registration values are not empty.
if (empty($_POST['club-name']) || empty($_POST['bio']) || empty($_POST['category']) || empty($_POST['contact']) || empty($_FILES['img']['name'])) {
	// One or more values are empty.
	exit('Please complete the registration form');
}

if ($_FILES["img"]["size"] > 5000000) {
	exit('Sorry, your image is too large.');
}

// We need to check if the account with that username exists.
if ($stmt = $con->prepare('SELECT clubID FROM club_table WHERE name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), hash the password using the PHP password_hash function.
	$stmt->bind_param('s', $_POST['club-name']);
	$stmt->execute();
	$stmt->store_result();
	// Store the result so we can check if the account exists in the database.
	if ($stmt->num_rows > 0) {
		// Username already exists
		echo 'Club name exists, please choose another!';
	} else {
		// Username doesnt exists, insert new account
		$target_dir = "images/";
		$imageFileType = strtolower(pathinfo($_FILES["img"]["name"],PATHINFO_EXTENSION));
		$_FILES["img"]["name"] = "clubphoto".$_SESSION['id'].'.'.$imageFileType;
		$target_file = $target_dir . basename($_FILES["img"]["name"]);
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["img"]["tmp_name"]);
		if($check !== false) {
			;
		} else {
			exit ("File is not an image.");
		}
		
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
			exit ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>");
		}
		
		if ($stmt = $con->prepare('INSERT INTO club_table (name, category, bio, contact) VALUES (?, ?, ?, ?)')) {
			$stmt->bind_param('ssss', $_POST['club-name'], $_POST['category'], $_POST['bio'], $_POST['contact']);
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

// Prepare our SQL, preparing the SQL statement will prevent SQL injection.
if ($stmt = $con->prepare('SELECT clubID FROM club_table WHERE name = ?')) {
	// Bind parameters (s = string, i = int, b = blob, etc), in our case the username is a string so we use "s"
	$stmt->bind_param('s', $_POST['club-name']);
	$stmt->execute();
	// Store the result so we can check if the account exists in the database.
	$stmt->store_result();
	// If the username exiusts
	if ($stmt->num_rows > 0) {
		$stmt->bind_result($clubid);
		$stmt->fetch();
		if ($stmt = $con->prepare('INSERT INTO membership_table (userID, clubID, admin) VALUES (?, ?, ?)')) {
			$admin = true;
			$stmt->bind_param('ssi', $_SESSION['id'], $clubid, $admin);
			$stmt->execute();
			$stmt->free_result();
			
			$_FILES["img"]["name"] = "clubphoto".$clubid.'.'.$imageFileType;
			$target_file = $target_dir . basename($_FILES["img"]["name"]);
			if (move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) {
				;
			} else {
				exit('There was a problem uploading the club image');
			}
			if ($stmt = $con->prepare('UPDATE club_table SET clubPhoto = ? WHERE clubID = ?')) {
			$stmt->bind_param('si', $_FILES['img']['name'], $clubid);
			$stmt->execute();
			echo 'You have successfully created a new club!';
			header('Location: club-profile-'.$clubid);
			}
			else {
				exit('Image error');
			}
		} else {
			// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
			echo 'Could not prepare statement!';
		}
	} else {
		exit('Error adding admin!');
	}
} else {
	exit('Error adding admin!');
}
?>