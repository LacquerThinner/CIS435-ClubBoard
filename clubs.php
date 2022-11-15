<!doctype html>
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
			margin-right: 10px;
			width: 25%;
			height: 100%;
			float: left;
			border-collapse: collapse;
			padding: 2rem;
		}

		.middlepane {
			margin-top: 10px;
			width: 70%;
			height: 100%;
			float: left;
			border-collapse: collapse;
			min-height: 100vh;
			padding: 2rem;  
			background-size: cover;
		}
		
		input[type=submit] {
		  background-color: silver;
		  color: black;
		  padding: 14px 20px;
		  margin: 8px 0;
		  border-color: black;
		  border-style: solid;
		  cursor: pointer;
		  width: 100%;
		}
		
		.grid-container {
			display: grid;
			grid-template-columns: 1fr;
			gap: 1rem;
		}
		
		.grid-item {
			width: 100%;
			height: 100px;
			background-color: silver;
		}
		
		.grid-item img{
			height: 100px;
			width: 100px;
			float: left;
			border-radius: 50%;
		}
		
		.grid-item h2{
			text-align: center;
		}
		
		.grid-item p{
			text-align: center;
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
  <body>
  
  <?php
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
	
		if (!isset ($_GET['page']) ) {  

			$page_number = 1;  

		} else {  

			$page_number = $_GET['page'];  

		}  

	// variable to store the number of rows per page

	$limit = 5;  

		// get the initial page number

		$initial_page = ($page_number-1) * $limit;
	// query to retrieve all rows from the table Countries

    $getQuery = "select *from club_table";  

    // get the result

    $result = mysqli_query($conn, $getQuery);  

    $total_rows = mysqli_num_rows($result); 

    // get the required number of pages

    $total_pages = ceil ($total_rows / $limit);

	$getQuery = "SELECT *FROM club_table LIMIT " . $initial_page . ',' . $limit;  

    $result = mysqli_query($conn, $getQuery);   
?>	
    
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
		
		<a class="nav-link profile" href="profile.html"><img src="images/avatar-placeholder.png" style="border-radius:50%;height:40px;width:40px;"></a>
      </div>
    </div>
  </nav>
</header>


<div class="container">
	<div class="leftpane">
		<h2>Have a club idea?</h2> 
		<p>Register a club with us!</p>
		<form action="club_registration.html">
			<input type="submit" value="Register a Club!"/>
		</form>

	</div>
	<div class="middlepane">
		<div class="grid-container">
		<?php
		    while ($row = mysqli_fetch_array($result)) {?> 
				<a href="club-profile.php?id=<?php echo $row['clubID'] ?>" style="color:black;text-decoration: none;">
					<div class="grid-item">
			<img src= <?php echo "images/" . $row['clubPhoto']; ?> alt="Club Photo">
						<h2><?php echo $row['name']; ?></h2>
						<p><?php echo $row['bio']; ?></p>
					</div>
				</a>
			<?php } ?>
			
			<p><?php
			for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

				echo '<a href = "clubs.php?page=' . $page_number . '">' . $page_number . ' </a>';  

			}  
			?></p>
		</div>
	</div>
</div>

  </body>
</html>