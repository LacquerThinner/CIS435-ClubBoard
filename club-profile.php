<!doctype html>
<?php // We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Wolverines Unite!</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.2/examples/carousel/">

    

    

<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }

      .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
      }

      .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
      }

      .bi {
        vertical-align: -.125em;
        fill: currentColor;
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
	  
	  .profile {
		align-items: right;
	  }
	  
	  .search_bar {
	    display: flex;
		align-items: center;
		width: 50rem;
        padding-bottom: 1rem;
        margin-top: -1px;
		}
		
	#searchBarWrap{
		display: flex;
		justify-content: center;
	}
    </style>

    
    <!-- Custom styles for this template -->
    <link href="carousel.css" rel="stylesheet">
  </head>
  <body>
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
		
		<a class="nav-link profile" href="profile.php"><img src="images/avatar-placeholder.png" style="border-radius:50%;height:40px;width:40px;"></a>
      </div>
    </div>
  </nav>
</header>


<main>
<?php
	$club_id = $_GET['id'];
	
	$conn = mysqli_connect('localhost', 'root', '');  

		// root is the default username 

		// ' ' is the default password

		if (! $conn) {  

				die("Connection failed" . mysqli_connect_error());  

		}  

		else {  

				// connect to the database named group6_db

				mysqli_select_db($conn, 'group6_db');  

		} 
		
		$getQuery = "select * from club_table where clubID = " . $club_id;
		
		$result = mysqli_query($conn, $getQuery);
		
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
         <h4 class="center"><?php echo $row['name']; ?></h4>	<!-- Going to add database functions to get user information 
												 using an ID, and eventually for clubs as well -->
         <p class="center circle"><img src= <?php echo "images/" . $row['clubPhoto']; ?> style="border-radius:50%; width:25%; height:25%;" alt="Avatar"></p>
         <hr>
         <p><img src="images/pencil.png" style="width:5%; height:5%;" alt="pencil"> <?php echo $row['bio']; ?></p>
         <p><img src="images/house.png" style="width:5%; height:5%;" alt="house"> <?php echo $row['contact']; ?></p>
        </div>
      </div>
      <br>
    
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
        <img src="images/avatar-placeholder.png" alt="Avatar" style="border-radius:50%; width:5%; height:5%;">
        <h5>Club Name</h5><br>
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
          <p><?php echo $row['catagory']; ?></p>
          <p>
            <span class="badge badge-primary">News</span>
            <span class="badge badge-secondary">W3Schools</span>
            <span class="badge badge-success">Bootstrap</span>
            <span class="badge badge-dark">Games</span>
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


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>
