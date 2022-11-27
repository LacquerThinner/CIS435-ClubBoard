<!doctype html>
<?php // We need to use sessions, so you should always start sessions using the below code.
session_start();
// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
	header('Location: login.html');
	exit;
}
// Check for the user's profile pictue
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
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clubs.php">Clubs</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="survey.html">Survey</a>
          </li>
        </ul>
		
		<a class="nav-link profile" href="profile.php"><img <img src=<?php echo "images/" . $photo; ?>  width="8%" height="8%" style="border-radius:50%;height:40px;width:40px;"></a>
      </div>
    </div>
  </nav>
</header>


<main>
<?php
	$club_id = $_GET['id'];
	$DATABASE_HOST = 'localhost';
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'group6_db';
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if (mysqli_connect_errno()) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
	}
	//get club's info
	$stmt = $con->prepare('SELECT name, category, bio, contact, clubPhoto FROM club_table WHERE clubID = ?');
	$stmt->bind_param('i', $club_id);
	$stmt->execute();
	$stmt->bind_result($name, $category, $bio, $contact, $clubPhoto);
	$stmt->fetch();
	$stmt->free_result();
	//get club's posts
	$stmt = $con->prepare('SELECT * FROM posts_table WHERE clubID = ?');
	$stmt->bind_param('i', $club_id); 
	$stmt->execute();
	$posts = $stmt->get_result();
	$stmt->free_result();
	//get club's events
	$stmt = $con->prepare('SELECT * FROM event_table WHERE clubID = ?');
	$stmt->bind_param('i', $club_id); 
	$stmt->execute();
	$events = $stmt->get_result();
	$stmt->free_result();
	//get member status
	$stmt = $con->prepare('SELECT * FROM membership_table WHERE clubID = ? && userID = ?');
	$stmt->bind_param('ii', $club_id, $_SESSION['id']); 
	$stmt->execute();
	$stmt->store_result();
	if($stmt->num_rows > 0) {
		$stmt = $con->prepare('SELECT admin FROM membership_table WHERE clubID = ? && userID = ?');
	    $stmt->bind_param('ii', $club_id, $_SESSION['id']); 
	    $stmt->execute();
		$admin = $stmt->get_result();
		$row = mysqli_fetch_array($admin);
		$isAdmin = $row['admin'];
		$isMember = true;
	}
	else {
		$isMember = false;
		$isAdmin = 0;
	}
	
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
         <h4 class="center"><?php echo $name; ?></h4>	<!-- Going to add database functions to get user information 
												 using an ID, and eventually for clubs as well -->
         <p class="center circle"><img src= <?php echo "images/" . $clubPhoto; ?> style="border-radius:50%; width:25%; height:25%;" alt="Avatar"></p>
         <hr>
         <p><img src="images/pencil.png" style="width:5%; height:5%;" alt="pencil"> <?php echo $bio; ?></p>
         <p><img src="images/house.png" style="width:5%; height:5%;" alt="house"> <?php echo $contact; ?></p>
        </div>
      </div>
      <br>
	  <!-- Interests --> 
      <div class="card">
        <div class="container">
          <p><?php echo $category; ?></p>
          <p>
            <span class="badge badge-primary">News</span>
            <span class="badge badge-secondary">W3Schools</span>
            <span class="badge badge-success">Bootstrap</span>
            <span class="badge badge-dark">Games</span>
          </p>
        </div>
      </div>
      <br>
<?php
if (! $isMember) {
	echo '<a role="button" class="btn btn-light" href="addMember.php?id='.$club_id.'">Join!</a>';
}
?>
    <!-- End Left Column -->
    </div>
    
    <!-- Middle Column -->
    <div class="col">
      <div class="row">
        <div class="col">
          <div class="card">
            <div class="container">
              <h3>Posts: </h3>
			  <?php
				while ($row = mysqli_fetch_array($posts)) {?> 
					<div class="container"><br>
						<h5><?php echo $row['title'];?></h5><br>
						<p><?php echo $row['content'];?></p><br>
						<hr class="clear">
					</div>
				<?php } ?>
                <?php
					if($isAdmin) {
						echo '<form action="addPost.php?id='.$club_id.'" method="post" autocomplete="off" enctype="multipart/form-data">
								<input type="text" name="title" placeholder="Title" id="title">
								<br>
								<textarea id="content" name="content" placeholder="Content" rows="4" cols="50"></textarea>
								<br>
							<input type="submit" value="Post">
						</form>';
					}
				?>
            </div>
          </div>
        </div>
      </div>
      
	  <?php
	  while ($row = mysqli_fetch_array($posts)) {?> 
		<div class="container"><br>
			<h5><?php echo $row['title'];?></h5><br>
			<hr class="clear">
			<p><?php echo $row['content'];?></p>
        </div>
	  <?php } ?>
    <!-- End Middle Column -->
    </div>
    
    <!-- Right Column -->
    <div class="col">
      <div class="card">
        <div class="container">
		  <h3>Upcoming Events:</h3>
		  <?php
			while ($row = mysqli_fetch_array($events)) {?> 
				<div class="container"><br>
					<p><strong><?php echo $row['title'];?></strong></p>
					<p><?php echo $row['description'];?></p>
					<p><?php echo $row['date'] . ' ' . $row['time'];?></p>
				</div>
			<?php } ?>
			
			<?php
				if($isAdmin) {
					echo '<form action="addEvent.php?id='.$club_id.'" method="post" autocomplete="off" enctype="multipart/form-data">
								<input type="text" name="title" placeholder="Title" id="title">
								<br>
								<input type="date" name="date" placeholder="Date" id="date">
								<input type="time" name="time" placeholder="Time" id="time">
								<br>
								<textarea id="description" name="description" placeholder="Description" rows="4" cols="50"></textarea>
								<br>
							<input type="submit" value="Post">
						</form>';
				}
			?>	
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
