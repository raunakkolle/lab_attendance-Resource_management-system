<?php
		
	session_start();
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }
	
	$email = $password = $designation = "";

	$em_email = "";
	$em_password = "";
	$em_designation="";
	
	if(isset($_POST['submit'])){
		// echo htmlspecialchars($_POST['email']);
		// echo htmlspecialchars($_POST['password']);

		//check email
		if(empty($_POST['email'])){
			$em_email = 'An Email is required <br>';
		} else {
			$email = $_POST['email'];
			//validating email
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$em_email = "Enter a valid email address";
			}
		}
		//check password
		if(empty($_POST['password'])){
			$em_password = 'A password is required <br>';
		} 
       
		else {
			$password = $_POST['password'];
		}

		if(empty($_POST['Designation'])){
			$em_designation = "Choose a Designation"; 
		} else {
			$designation = $_POST['Designation'];
		}

		if($em_email =="" && $em_password == "" && $em_designation=="")
		{
			//to prevent mysql injection
			$email = stripcslashes($email);
			$password = stripcslashes($password);
			$designation = stripcslashes($designation);
			// $email = mysql_real_escape_string($email);
			// $password = mysql_real_escape_string($password);
			// $designation = mysql_real_escape_string($designation);

			//connect to server and select database
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
			$result = mysqli_query($conn, "select * from users where email = '$email' and password = md5('$password') and designation = '$designation'")
						or die("Failed to query database");

			$_SESSION['varname'] = $email;
			$count = mysqli_num_rows($result);
			if($count == 0){
				echo '<script>alert("Invalid Email or Password")</script>';
			} else {
				if($designation == "Faculty")
					header('Location: ./Faculty/mainpage.php');
				else if($designation == "Student")
					header('Location: ./Student/mainpage.php');
				else
					header('Location: ./Admin/mainpage.php');
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
		<h4 class="center">Enter Login Details</h4>
		<form class="white" action="login.php" method="POST">
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
			<p class="ftext">Your Designation:</p>
			  <input type="radio" id="Admin" name="Designation" value="Admin">
			  <label for="Admin">Admin</label><br>
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
			<div class="center">
				<span class="ftext1">
					<input type="submit" name="submit" value="login" class="btn brand z-depth-0">
				</span>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php') ?>

</html>