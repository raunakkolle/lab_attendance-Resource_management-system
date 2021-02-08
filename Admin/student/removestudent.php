<?php

	$fname = $lname = $USN = "";
	$em_usn = "";
	$f = 1;

	if(isset($_POST['submit'])){
		if(!empty($_POST['fname'])){
			$fname = $_POST['fname'];
		}

		if(!empty($_POST['lname'])){
			$lname = $_POST['lname'];
		}
		
		if(empty($_POST['usn'])){
			$em_usn = 'Student USN is required!';
			$f = 0;
		} else {
			$USN = $_POST['usn'];
		}

		if($f == 1){
			// echo $fname,$lname,$USN;
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
			$result = mysqli_query($conn, "DELETE from student WHERE USN = '$USN' ");
			if($result == True){
				echo '<script>
					alert("Deletion from table successful");
					window.location.href="../userprofiles.php";
					</script>';
			}
		}
	}

?>
<!DOCTYPE html>
<html>
	
	<?php include('../../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="../userprofiles.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Enter Details of Student to be Removed</h4>
	<section class="container grey-text">
		<form class="white" action="removestudent.php" method="POST">

			<label style="font-weight: bold;" class="ftext">First Name:</label>
			<input type="text" name="fname" value="<?php echo $fname ?>">

			<label style="font-weight: bold;" class="ftext">Last Name:</label>
			<input type="text" name="lname" value="<?php echo $lname ?>">
			
			<label style="font-weight: bold;" class="ftext">Student USN:</label>
			<input type="text" name="usn" value="<?php echo $USN ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_usn;
				?>
			</div>

			<div class="center" style="margin-top: 25px;">
				<span class="ftext1">
					<input type="submit" name="submit" value="CONFIRM & REMOVE STUDENT" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>