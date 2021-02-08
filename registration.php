<?php
		
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }
	
	$name = $email = $password = $designation = "";
	
	$em_name = "";
	$em_email = "";
	$em_password = "";
	$em_designation = "";

	if(isset($_POST['submit'])){
		// echo htmlspecialchars($_POST['email']);
		// echo htmlspecialchars($_POST['password']);

		//check name
		if(empty($_POST['name'])){
			$em_name = 'A Name is required <br />';
		} else{
			$name = $_POST['name'];
			//validating name
			if(!preg_match('/[a-zA-Z\s]+$/', $name)){
				$em_name = 'Name must be letters and spaces only';
			}
		}

		//check email
		if(empty($_POST['email'])){
			$em_email = 'An Email is required <br/>';
		} else {
			$email = $_POST['email'];
			//validating email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$em_email = "Enter a valid email address";
			}
		}
		//check password
		if(empty($_POST['password'])){
			$em_password = 'A password is required';
		} else {
			$password = $_POST['password'];
			// echo htmlspecialchars($_POST['password']);
		}

		if(empty($_POST['Designation'])){
			$em_designation = "Choose a Designation"; 
		} else {
			$designation = $_POST['Designation'];
			// echo htmlspecialchars($_POST['Designation']);
		}

		if($em_name == "" && $em_email =="" && $em_password == "" && $em_designation==""){

			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
			$result = mysqli_query($conn, "insert into users values ('NULL','$email',
					md5('$password'),'$designation')");
			if($result == True){
				echo '<script>
				alert("Successfully Registered!");
				window.location.href="./login.php";
				</script>';
			}
		}

	} //end of post check

?>

<!DOCTYPE html>
<html>

	<style>
	body {
	  background-image: url('./bg1.jpg');
	  background-repeat: no-repeat;
	  background-attachment: fixed;
  	  background-size: 100% 100%;
	}
	</style>

	<script>
		function myFunction() {
		  var x = document.getElementById("myInput");
		  if (x.type === "password") {
		    x.type = "text";
		  } else {
		    x.type = "password";
		  }
		}
	</script>
	
	<?php include('templates/header.php') ?>

	<section class="container grey-text">
		<h4 class="center">Registration</h4>
		<form class="white" action="registration.php" method="POST">
			<label class="ftext">Your Name:</label>
			<input type="text" name="name" value="<?php echo $name ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_name;
				?>
			</div>

			<label class="ftext">Your Email:</label>
			<input type="text" name="email" value="<?php echo $email ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_email;
				?>
			</div>

			<label class="ftext">Your Password:</label>
			<input type="password" name="password" id="myInput" value="<?php echo $password ?>">
			<br>
			<div class="ftext1">
				<input type="checkbox" id="checkbox" onclick="myFunction()" />
				<label for="checkbox">Show Password</label>
			</div>
			<div class="right" id="errormessage">
				<?php
					echo $em_password;
				?>
			</div>

			<p class="ftext">Register As:</p>
			  <input type="radio" id="Faculty" name="Designation" value="Faculty">
			  <label for="Faculty">Faculty</label><br>
			  <input type="radio" id="Student" name="Designation" value="Student">
			  <label for="Student">Student</label>

			<div class="right" id="errormessage">
				<?php
					echo $em_designation;
				?>
			</div>

			<br>
			<br>
			
			<div class="center">
				<span class="ftext1">
					<input type="submit" name="submit" value="register" class="btn brand z-depth-0">
				</span>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php') ?>

</html>