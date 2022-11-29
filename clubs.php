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
			width: 100%;
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
			width: 100%; /* Try setting this to 400px or something */
			display: table;
		}
		
		.child {
			display: table-cell;
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
	//$conn = mysqli_connect('localhost', 'root', '');
	$conn = mysqli_connect('141.215.80.154', 'group6', 'DDFLa@mq7SR');  

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

	$limit = 15;  

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
    
	<div class="middlepane">
		<div class="grid-container">
		<?php
			$row_count = 0;
		
		    while ($row = mysqli_fetch_array($result)) {
				if ($row_count > 2){
					echo $row_count;
					$row_count = 0;
				?>
				</div>
				<div class="grid-container">
				<?php
				}
				
				$row_count += 1;
				?>
					<div class="col-lg-4 child">
						<img src=<?php echo "images/" . $row['clubPhoto']; ?> width="140" height="140" alt="Club Photo" style="border-radius:50%">

						<h2 class="fw-normal"><?php echo $row['name']; ?></h2>
						<p><a class="btn btn-secondary" href="<?php echo 'club-profile-' . $row['clubID'] ?>">View details &raquo;</a></p>
					</div><!-- /.col-lg-4 -->

				<!--<a href="<?php echo 'club-profile-' . $row['clubID'] ?>" style="color:black;text-decoration: none;">
					<div class="grid-item">
			<img src= <?php echo "images/" . $row['clubPhoto']; ?> alt="Club Photo">
						<h2><?php echo $row['name']; ?></h2>
						<p><?php echo $row['bio']; ?></p>
					</div>
				</a>-->
			<?php } ?>
			<p><?php
			for($page_number = 1; $page_number<= $total_pages; $page_number++) {  

				echo '<a href = "clubs-' . $page_number . '">' . $page_number . ' </a>';  

			}  
			?></p>
		</div>
	</div>
  </body>
</html>