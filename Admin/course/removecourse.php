<?php

	$courseID = "";
	$dept = "";

	$em_cid = "";
	$em_dept = "";

	$f = 1;

	
	if(isset($_POST['submit'])){

		if(empty($_POST['cid'])){
			$em_cid = 'Enter Course_ID';
			$f = 0;
		} else{
			$courseID = $_POST['cid'];
		}

		if(empty($_POST['dept'])){
			$em_dept = 'Enter Department';
			$f = 0;
		} else{
			$dept = $_POST['dept'];
			//validating name
			if(!preg_match('/[a-zA-Z\s]+$/', $dept)){
				$em_dept = 'Name must be letters and spaces only';
				$f = 0;
			}
		}

		if($f == 1){

			// echo $courseID,$dept;
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			$result = mysqli_query($conn, "DELETE from course WHERE Course_ID ='$courseID' and Name_of_Dept = '$dept'");
			if($result == True){
				echo '<script>
					alert("Deletion from table successful");
					window.location.href="../managecourse.php";
					</script>';
			}
		}
	
	}
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('../../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="../managecourse.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Enter Course Details to be removed</h4>
	<section class="container grey-text">
		<form class="white" action="removecourse.php" method="POST">

			<label style="font-weight: bold;" class="ftext">Course_ID:</label>
			<input type="text" name="cid" value="<?php echo $courseID?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_cid;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Department:</label>
			<input type="text" name="dept" value="<?php echo $dept ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_dept;
				?>
			</div>

			<div class="center" style="margin-top: 30px;">
				<span class="ftext1">
					<input type="submit" name="submit" value="CONFIRM & REMOVE COURSE" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>