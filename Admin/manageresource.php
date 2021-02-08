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
	<h4 class="center grey-text">Manage Resource</h4>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./resource/addresource.php" class="btn brand z-depth-0">Add Resource </a> &emsp;
				<a href="./resource/removeresource.php" class="btn brand z-depth-0">Remove Resource</a>
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./resource/choosedept.php" class="btn brand z-depth-0">View Resource List</a> 
			</div>
		</form>
	</section>
	<section class="container grey-text">
		<form class="white">
			<div class="center ftext">
				<a href="./resource/resourceusage.php" class="btn brand z-depth-0">Resource Usage Summary</a> 
			</div>
		</form>
	</section>
	<?php include('../templates/footer.php') ?>

</html>