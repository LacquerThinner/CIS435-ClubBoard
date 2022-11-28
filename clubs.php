<!doctype html>
<?php // We need to use sessions, so you should always start sessions using the below code.
session_start();
// Check for the user's profile pictue
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
	
		if (!isset ($params['page']) ) {  

			$page_number = 1;  

		} else {  

			$page_number = $params['page'];  

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
    


<?php
if (isset($_SESSION['loggedin'])) {
	echo '<div class="container">
	<div class="leftpane">
		<h2>Have a club idea?</h2> 
		<p>Register a club with us!</p>
		<form action="club_registration.html">
			<input type="submit" value="Register a Club!"/>
		</form>';
}
?>
	</div>
	<div class="middlepane">
		<div class="grid-container">
		<?php
		    while ($row = mysqli_fetch_array($result)) {?> 
				<a href="<?php echo 'club-' . $row['clubID'] ?>" style="color:black;text-decoration: none;">
					<div class="grid-item">
			<img src= <?php echo "images/" . $row['clubPhoto']; ?> alt="Club Photo">
						<h2><?php echo $row['name']; ?></h2>
						<p><?php echo $row['bio']; ?></p>
					</div>
				</a>
			<?php } ?>
			
			<p><?php
			for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

				echo '<a href = "/ClubBoard/clubs-' . $page_number . '">' . $page_number . ' </a>';  

			}  
			?></p>
		</div>
	</div>
</div>

  </body>
</html>