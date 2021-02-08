<?php
	//echo 'Hello PHP Web Dev!!';
	//echo 'Hello! DBMS Project';
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="../index.php" class="btn brand z-depth-0">Logout</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Welcome to Admin Home Page</h4>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./userprofiles.php" class="btn brand z-depth-0">Maintain User Profile</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./managecourse.php" class="btn brand z-depth-0">Manage Courses</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./manageresource.php" class="btn brand z-depth-0">Manage Resources</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./generatereport.php" class="btn brand z-depth-0">Generate Report</a>
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php') ?>

</html>