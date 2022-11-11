<!doctype html>
<?php
session_start();
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
            <a class="nav-link active" aria-current="page" href="index.html">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clubs.php">Clubs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="survey.html">Survey</a>
          </li>
        </ul>
      </div>
	 <a style="text-align:right" role="button" href="profile.html"><img src="images/avatar-placeholder.png" width="4%" height="4%" style="border-radius:50%"></img></a>
    </div>
  </nav>
</header>

<?php
//require('database.php');
//Get UserID for attribute references to fill out profile
$user_id = $_GET['id'];

$conn  = mysqli_connect('localhost', 'root', '');
if(!$conn){
	die("Connection failed".mysqli_connect_error());
}
else  {
	//Connect to database named group6_db
	mysqli_select_db($conn, 'group6_db');
}

//Query user
$queryUser = "SELECT * FROM user_table WHERE userID = " . $user_id;
$result = mysqli_query($conn, $queryUser);
$row = mysqli_fetch_array($result);
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
         <h4 class="center"><?php echo $row['fname']; echo ' '; echo $row['lname']; ?></h4>
         <p class="center circle"><img src=<?php echo "images/" . $row['userPhoto']; ?> width="25%" height="25%" style="border-radius:50%" alt="Avatar"></p>
         <hr>
         <p><img src="images/pencil.png" width="5%" height="5%"></img> Job Title, Company / School</p>
         <p><img src="images/house.png" width="5%" height="5%"></img><?php echo ' ' . $row['email']; ?></p>
         <p><img src="images/cake.png" width="5%" height="5%"></img><?php echo ' ' . $row['bio']; ?></p>
        </div>
      </div>
      <br>
      
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
			<?php //Query all clubs to see if this user is in them, need to add some relation
				//$queryUserGroups = "SELECT * FROM club_table WHERE ";	
				//$result2 = mysqli_query($conn, $queryUserGroups);
				//$groups = mysqli_fetch_array($result2);
			?>
			  
		  </div>
		  </div>
		</div>
		<div class="accordion-item">
		  <h2 class="accordion-header" id="headingTwo">
			<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
			  My Events
			</button>
		  </h2>
		  <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionProfile">
		  <div class="accordion-body">

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
    
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="col">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="container">
              <p contenteditable="true">Post: </p>
              <button type="button" class="btn btn-outline-primary"> Tag</button> 
            </div>
          </div>
        </div>
      </div>
      
      <div class="container"><br>
        <img src=<?php echo "images/" . $row['userPhoto']; ?> alt="Avatar" width="5%" height="5%" style="border-radius:50%">
        <h5>John Doe</h5><br>
        <hr class="clear">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
          
        <button type="button" class="btn btn-light">  Like</button> 
        <button type="button" class="btn btn-light">  Comment</button> 
      </div>
      
      
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="col">
      <div class="card">
        <div class="container">
          <p>Upcoming Events:</p>
		  <img src="images/forest.jpg" alt="Forest" style="width:50%;">
          <p><strong>Camping</strong></p>
          <p>Friday, ... 3:00pm</p>
          <p><button type="button" class="btn btn-info">Info</button></p>
        </div>
      </div>
      <br>
    
	<!-- Interests --> 
      <div class="card">
        <div class="container">
          <p>Interests/Tags</p>
          <p>
            <!-- going to add an editable portion a user could add their own tags -->
          </p>
        </div>
      </div>
      <br>
	
    <!-- End Right Column -->
    </div>
    
  <!-- End Grid -->
  </div>
  
<!-- End Page Container -->
</div>
<br>

<!-- Footer -->
<footer class="w3-container w3-theme-d3 w3-padding-16">
  <h5>Footer</h5>
</footer>

<footer class="w3-container w3-theme-d5">
  <p>Powered by <a href="https://www.w3schools.com/w3css/default.asp" target="_blank">w3.css</a></p>
</footer>

</body>
</html> 
