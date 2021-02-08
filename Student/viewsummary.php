<?php
	//echo 'Hello PHP Web Dev!!';
	//echo 'Hello! DBMS Project';
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="./mainpage.php" class="btn brand z-depth-0">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Attendance Summary</h4>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./consolidatedlist.php" class="btn brand z-depth-0">View Consolidated List</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./absentlist.php" class="btn brand z-depth-0">View Absent Dates</a> 
			</div>
		</form>
	</section>
	
	<?php include('../templates/footer.php') ?>

</html>