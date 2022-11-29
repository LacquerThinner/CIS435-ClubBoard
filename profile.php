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
  <head>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="social media template by w3.css">
    <meta name="author" content="w3schools">
    <meta name="generator" content="">
    <title>Wolverines Unite!</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">
	
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
	
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
  </head>

<!--Navbar-->
<header>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Wolverines Unite!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav me-auto mb-2 mb-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clubs-1">Clubs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="survey.html">Survey</a>
          </li>
        </ul>
      </div>
	 <a style="text-align:right" role="button" href="profile.html"><img src=<?php echo "images/" . $photo; ?>  width="8%" height="8%" style="border-radius:50%"></img></a>
    </div>
  </nav>
</header>

<?php
$DATABASE_HOST = 'localhost';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'group6_db';
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
if (mysqli_connect_errno()) {
	exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// We don't have the password or email info stored in sessions so instead we can get the results from the database.
$stmt = $con->prepare('SELECT password, email, realname, bio FROM user_table WHERE userID = ?');
// In this case we can use the account ID to get the account info.
$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email, $realname, $bio);
$stmt->fetch();
$stmt->free_result();

$stmt = $con->prepare('SELECT DISTINCT club_table.clubID, club_table.name, club_table.clubPhoto FROM membership_table INNER JOIN club_table ON membership_table.clubID = club_table.clubID WHERE membership_table.userID = ?;');
// In this case we can use the account ID to get the account info.
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
