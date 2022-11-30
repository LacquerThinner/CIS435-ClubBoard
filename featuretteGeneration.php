<?php
//connect to the database
include('sql/sqlCredentials.php');

//create statement
$getQuery = 'SELECT clubID, name, bio, clubPhoto FROM club_table ORDER BY clubID DESC LIMIT 3';
$resultFeature = mysqli_query($con, $getQuery);
?>

<html>
<h2 style="text-align:center; padding-top:20px">Recently Created Clubs</h2>
	<div class="container marketing">
		<div class="row" style="padding-top: 20px">
			<?php
			while ($row = mysqli_fetch_array($resultFeature)){
			?>
			<div class="col-lg-4">
				<img src=<?php echo "images/" . $row['clubPhoto']; ?> width="140" height="140" alt="Club Photo" style="border-radius:50%">
				<h2 class="fw-normal"><?php echo $row['name'] ?></h2>
				<p><?php echo $row['bio'] ?></p>
				<p><a class="btn btn-secondary" href="<?php echo 'club-profile-' . $row['clubID']?>">View details &raquo;</a></p>
			</div>
			<?php
			}
			?>
		</div>
	</div>
</html>