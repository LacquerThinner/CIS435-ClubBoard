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
if (isset($_POST['realname']) && !empty($_POST['realname'])) {
	// name must below 40 characters long.
	if (strlen($_POST['realname']) > 40) {
		exit('name must be less than 40 characters long!');
	}
	
	if ($stmt = $con->prepare('UPDATE user_table SET realname = \''.$_POST['realname'].'\' WHERE userID = '.$_SESSION['id'].';')) {
		$stmt->execute();
		echo 'Name change saved!<br><a href="profile.php">Return to Profile</a><br>';
	} else {
		// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
		echo 'Could not change name.';
	}
}

if (isset($_POST['bio'])  && !empty($_POST['bio'])) {
	$_POST['bio'] = str_replace("'", "\'", $_POST['bio']);
	if ($stmt = $con->prepare('UPDATE user_table SET bio = \''.$_POST['bio'].'\' WHERE userID = '.$_SESSION['id'].';')) {
		$stmt->execute();
		echo 'Bio change saved!<br>';
	} else {
		// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
		echo 'Could not change bio';
	}
}

if (isset($_FILES["userphoto"]) && !empty($_FILES["userphoto"]["name"])) {
	$target_dir = "images/";
	$imageFileType = strtolower(pathinfo($_FILES["userphoto"]["name"],PATHINFO_EXTENSION));
	$_FILES["userphoto"]["name"] = "userphoto".$_SESSION['id'].'.'.$imageFileType;
	$target_file = $target_dir . basename($_FILES["userphoto"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES["userphoto"]["tmp_name"]);
	if($check !== false) {
		$uploadOk = 1;
	} else {
		echo "File is not an image.";
		$uploadOk = 0;
	}
	
	// Check file size
	if ($_FILES["userphoto"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.<br>";
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["userphoto"]["tmp_name"], $target_file)) {
			echo "The file ". htmlspecialchars( basename( $_FILES["userphoto"]["name"])). " has been uploaded.";
			if ($stmt = $con->prepare('UPDATE user_table SET userPhoto = \''.$_FILES["userphoto"]["name"].'\' WHERE userID = '.$_SESSION['id'].';')) {
			$stmt->execute();
			echo 'Photo change Saved!<br><a href="profile.php">Return to Profile</a>';
			} else {
				// Something is wrong with the sql statement, check to make sure accounts table exists with all 3 fields.
				echo 'Could not change profile picture<br>';
			}
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}
}
?>