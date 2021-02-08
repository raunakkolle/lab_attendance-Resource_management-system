<?php
	//echo 'Hello PHP Web Dev!!';
	//echo 'Hello! DBMS Project';
?>

<!DOCTYPE html>
<html>
	
	<?php include('../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="./mainpage.php" class="btn brand z-depth-0">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Manage Courses</h4>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./course/addcourse.php" class="btn brand z-depth-0">Add Course </a> &emsp;
				<a href="./course/removecourse.php" class="btn brand z-depth-0">Remove Course</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./course/courselist.php" class="btn brand z-depth-0">View Course List</a> 
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php') ?>

</html>