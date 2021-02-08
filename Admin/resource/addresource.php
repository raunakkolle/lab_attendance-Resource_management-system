<?php

	$department = "";
	$resource_type = "";

	$em_dept = "";
	$em_rtype = "";

	$f = 1;

	
	if(isset($_POST['submit'])){

		if(empty($_POST['Department'])){
			$em_dept = "Choose a Department"; 
		} else {
			$department = $_POST['Department'];
		}

		if(empty($_POST['rtype'])){
			$em_rtype = 'Enter Resource Type';
			$f = 0;
		} else{
			$resource_type = $_POST['rtype'];
			//validating name
			if(!preg_match('/[a-zA-Z\s]+$/', $resource_type)){
				$em_rtype = 'Name must be letters and spaces only';
				$f = 0;
			}
		}

		if($f == 1){

			// echo $resource_ID,$resource_type;
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			$result = mysqli_query($conn, "insert into resourcerecord values ('$department','$resource_type')");
			if($result == True){
				echo '<script>
					alert("Insertion into table successful");
					window.location.href="./addresource.php";
					</script>';
			}
		}
	
	}
	
?>

<!DOCTYPE html>
<html>
	
	<?php include('../../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="../manageresource.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Enter Resource Details to be added</h4>
	<section class="container grey-text">
		<form class="white" action="addresource.php" method="POST">

			<p class="ftext" style="font-weight: bold">Choose Department:</p>
			  <input type="radio" id="Computer Science & Engineering" name="Department" value="Computer Science & Engineering">
			  <label for="Computer Science & Engineering">Computer Science & Engineering</label><br>

			  <input type="radio" id="Electronics & Communication Engineering" name="Department" value="Electronics & Communication Engineering">
			  <label for="Electronics & Communication Engineering">Electronics & Communication Engineering</label>

			  <input type="radio" id="Electrical & Electronics Engineering" name="Department" value="Electrical & Electronics Engineering">
			  <label for="Electrical & Electronics Engineering">Electrical & Electronics Engineering</label>

			  <input type="radio" id="Information Science & Engineering" name="Department" value="Information Science & Engineering">
			  <label for="Information Science & Engineering">Information Science & Engineering</label><br>
			  
			  <input type="radio" id="Electronics & Telecommunication Engineering" name="Department" value="Electronics & Telecommunication Engineering">
			  <label for="Electronics & Telecommunication Engineering">Electronics & Telecommunication Engineering</label><br>
			<br>

			<div class="right" id="errormessage">
				<?php
					echo $em_dept;
				?>
			</div> 

			<br>

			<label style="font-weight: bold;" class="ftext">Resource Type:</label>
			<input type="text" name="rtype" value="<?php echo $resource_type ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_rtype;
				?>
			</div>

			<div class="center" style="margin-top: 30px;">
				<span class="ftext1">
					<input type="submit" name="submit" value="CONFIRM & ADD RESOURCE" class="btn brand z-depth-0">
				</span>
			</div>

		</form>
	</section>
	
	<?php include('../../templates/footer.php') ?>

</html>