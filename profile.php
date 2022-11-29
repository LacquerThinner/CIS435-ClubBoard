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
	
    <style>
	button {
	  background-color: silver;
	  color: black;
	  padding: 14px 20px;
	  margin: 8px 0;
	  border-color: black;
	  border-style: solid;
	  cursor: pointer;
	  width: 100%;
	}
		
		body, html {
			width: 100%;
			height: 100%;
			margin: 0;
		}
		
		.container {
			width: 100%;
			height: 100%;
		}
		
		.leftpane {
			margin-top: 10px;
			width: 20%;
			height: 100%;
			float: left;
			background-color: rosybrown;
			border-collapse: collapse;
		}

		.middlepane {
			margin-top: 10px;
			width: 80%;
			height: 100%;
			float: left;
			background-color: royalblue;
			border-collapse: collapse;
		}
	
      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
      }

      .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
      }
    </style>
	
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
         <p class="center circle"><img src=<?php echo "images/" . $photo; ?> width="25%" height="25%" style="border-radius:50%" alt="Avatar"></p>
         <hr>
         <p><img src="images/pencil.png" width="5%" height="5%"></img><?php echo $realname; ?></p>
         <p><img src="images/house.png" width="5%" height="5%"></img><?php echo ' ' . $email; ?></p>
         <p><img src="images/pencil.png" width="5%" height="5%"></img><?php echo ' ' . $bio; ?></p>
		 <a role="button" class="btn btn-light" href="editUser.html">Edit Profile</a>
		 <a role="button" class="btn btn-light" href="logout.php">Log Out</a>
        </div>
      </div>
      <br>
    <!-- End Left Column -->
    </div>
    
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
					<div class="grid-item">
			<p><img src= <?php echo "images/" . $row['clubPhoto']; ?> width="15%" height="15%" alt="Club Photo"> <?php echo $row['name']; ?></p>
					</div>
				</a>
			<?php } ?>
			  
		  </div>
		  </div>
		</div>
		<!-- Optional photos portion of accordion for user personalization
		<div class="accordion-item">
		  <h2 class="accordion-header" id="headingThree">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
			  My Photos
			</button>
		  </h2>
		  <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
		  <div class="accordion-body">
			
		  </div>
		  </div>
		</div>
		-->
	  </div>
      
    <!-- End Right Column -->
    </div>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html> 
