<?php

	$courseID = "";
	$credits = "";
	$dept = "";
	$coursedesc = "";

	$em_cid = $em_credits = "";
	$em_dept = $em_desc = "";

	$f = 1;

	
	if(isset($_POST['submit'])){

		if(empty($_POST['cid'])){
			$em_cid = 'Enter Course_ID';
			$f = 0;
		} else{
			$courseID = $_POST['cid'];
		}

		if(empty($_POST['credits'])){
			$em_credits = 'Enter Credits';
			$f = 0;
		} else{
			$credits = (int)$_POST['credits'];
			if(!is_int($credits) || $credits<0){
				$em_credits = "Enter a valid positive integer!";
				$f = 0;
			}
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

		if(empty($_POST['desc'])){
			$em_desc = 'Enter Course Description';
			$f = 0;
		} else{
			$coursedesc = $_POST['desc'];
		}

		if($f == 1){

			// echo $courseID,$credits,$coursedesc,$dept;
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			$result = mysqli_query($conn, "insert into course values ('$courseID','$credits','$dept','$coursedesc')");
			if($result == True){
				echo '<script>
					alert("Insertion into table successful");
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

	<h4 class="center grey-text">Enter Course Details to be added</h4>
	<section class="container grey-text">
		<form class="white" action="addcourse.php" method="POST">

			<label style="font-weight: bold;" class="ftext">Course_ID:</label>
			<input type="text" name="cid" value="<?php echo $courseID?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_cid;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Course Credits:</label>
			<input type="text" name="credits" value="<?php echo $credits ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_credits;
				?>
			</div>

			<label style="font-weight: bold;" class="ftext">Course Description:</label>
			<input type="text" name="desc" value="<?php echo $coursedesc ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_desc;
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
					<input type="submit" name="submit" value="CONFIRM & ADD COURSE" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>