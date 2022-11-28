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
	input[type=text], input[type=password] {
	  width: 100%;
	  padding: 12px 20px;
	  margin: 8px 0;
	  display: inline-block;
	  border: 1px solid #ccc;
	  box-sizing: border-box;
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
	
		.login-container {
			border-color: black;
			border-style: groove;
			padding-left: 25px;
			padding-right:25px;
			text-align: center;
			margin-left: auto;
			margin-right: auto;
			margin-top: 25px;
			width: 21em
		}
		
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
		
		<a class="nav-link profile" href="profile.html"><img src="images/avatar-placeholder.png" style="border-radius:50%;height:40px;width:40px;"></a>
      </div>
    </div>
  </nav>
</header>

<main>
<form action="login.php" method="post">
	<div class="login-container">
		<h1 href="#"><b>Wolverines Unite!</b></h1><br>
	
		<label for="uname">
			<i class="fas fa-user"></i>
		</label>
		<input type="text" placeholder="Username" name="uname" required>
		
		<label for="psw"><b>Password</b></label>
		<input type="password" placeholder="Password" name="psw" required>
		
		<input type="submit">Login</button>
</main>


    <script src="assets/dist/js/bootstrap.bundle.min.js"></script>

      
  </body>
</html>