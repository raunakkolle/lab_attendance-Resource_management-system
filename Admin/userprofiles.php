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
	<h4 class="center grey-text">User Profiles</h4>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./faculty/addfaculty.php" class="btn brand z-depth-0">Add Faculty </a> &emsp;
				<a href="./faculty/removefaculty.php" class="btn brand z-depth-0">Remove Faculty</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./faculty/facultylist.php" class="btn brand z-depth-0">View Faculty List</a> 
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./student/addstudent.php" class="btn brand z-depth-0">Add Student</a> &emsp;
				<a href="./student/removestudent.php" class="btn brand z-depth-0">Remove Student</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./student/studentlist.php" class="btn brand z-depth-0">View Student List</a>
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php') ?>

</html>