<?php
	
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="../index.php" class="btn brand z-depth-0">Logout</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Welcome to Faculty Home Page</h4>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./markattendance.php" class="btn brand z-depth-0">Mark Attendance</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./attendancesummary.php" class="btn brand z-depth-0">Attendance Summary</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./profiledetails.php" class="btn brand z-depth-0">Profile Details</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./analyzedata.php" class="btn brand z-depth-0">Analyze Data</a>
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php') ?>

</html>