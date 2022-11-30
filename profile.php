<!doctype html>
<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
if (isset($_SESSION['photo'])) {
	$photo = $_SESSION['photo'];
}
else {
	$photo = 'avatar-placeholder.png';
}
?>
<html lang="en">
	
 <?php
  include('header.php');
  ?>
	
<!-- Custom styles for this template -->
<link href="carousel.css" rel="stylesheet">

<?php
//connect to the database
include('sql/sqlCredentials.php');
$stmt = $con->prepare('SELECT password, email, realname, bio FROM user_table WHERE userID = ?');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $realname, $bio);
$stmt->fetch();
$stmt->free_result();

$stmt = $con->prepare('SELECT DISTINCT club_table.clubID, club_table.name, club_table.clubPhoto FROM membership_table INNER JOIN club_table ON membership_table.clubID = club_table.clubID WHERE membership_table.userID = ?;');
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$clubs = $stmt->get_result();
$stmt->free_result();
?>

<!-- Page Container -->
<div class="container" style="max-width:1400px;margin-top:80px">    
  <!-- The Grid -->
  <div class="row align-items-start">
    <!-- Left Column -->
    <div class="col">
      <!-- Profile -->
      <div class="card">
        <div class="container">
         <h4 class="center"><?php echo $_SESSION['name']; ?></h4>
         <p class="center circle"><img src=<?php echo "userImages/" . $photo; ?> style="border-radius:50%;height:25%;width:25%;" alt="Avatar"></p>
         <hr>
		 <?php 
		 if ($realname != Null) {
			echo '<p><img src="images/name.png" style="height:5%;width:5%;" alt="Name">' . $realname . '</p>';
		 } else {
			echo '<p><img src="images/name.png" style="height:5%;width:5%;" alt="Name">Your Name</p>';
		 }
		 if ($bio != Null) {
			echo '<p><img src="images/pencil.png" style="height:5%;width:5%;" alt="Pencil">' . $bio . '</p>';
		 } else {
			echo '<p><img src="images/pencil.png" style="height:5%;width:5%;" alt="Pencil">Bio</p>';
		 }
		 if ($email != Null) {
			echo '<p><img src="images/envelope.png" style="height:5%;width:5%;" alt="Envelope">' . $email . '</p>';
		 } else {
			echo '<p><img src="images/envelope.png" style="height:5%;width:5%;" alt="Envelope">E-Mail</p>';
		 }
		 ?>
		 <a role="button" class="btn btn-light" href="editUser.html">Edit Profile</a>
		 <a role="button" class="btn btn-light" href="logout.php">Log Out</a>
        </div>
      </div>
    </div>
    <!-- End Left Column -->
	
    <!-- Middle Column -->
    <div class="col">
	  <!-- Accordion -->
	  <div class="accordion" id="accordionProfile">
		<div class="accordion-item">
		  <h2 class="accordion-header" id="headingOne">
			<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
			  My Groups
			</button>
		  </h2>
		  <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionProfile">
		  <div class="accordion-body">
			<?php
		    while ($row = mysqli_fetch_array($clubs)) {?> 
				<a href="<?php echo 'club-profile-' . $row['clubID'] ?>" style="color:black;text-decoration: none;">
					<div class="col-lg-4 child">
			<p><img src= <?php echo "images/" . $row['clubPhoto']; ?> style="height:15%;width:15%;" alt="Club Photo"> <?php echo $row['name']; ?></p>
					</div>
				</a>
				<a role="button" class="btn btn-light" href="leaveClub.php?id=<?php echo $row['clubID'] ?>" >Leave Club</a>
			<?php } ?>
			  
		  </div>
		  </div>
		</div>
	  </div>
    </div>
   </div>
 </div>
    <!-- End Right Column -->  
<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html> 
