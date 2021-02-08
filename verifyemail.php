<?php
		
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }
	
	$email = "";
	$designation = "";
	
	$em_email = "";
	$em_designation = "";

	if(isset($_POST['check'])){
		// echo htmlspecialchars($_POST['email']);
		// echo htmlspecialchars($_POST['password']);

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

		if(empty($_POST['Designation'])){
			$em_designation = "Choose a Designation"; 
		} else {
			$designation = $_POST['Designation'];
			// echo htmlspecialchars($_POST['Designation']);
		}

		$registered = 0;
		$n = $m = 0;
	
		if($em_email ==""){
			
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");

			if($designation == "Faculty"){
				$result1 = mysqli_query($conn, "select * from faculty where Email = '$email'")
						or die("Failed to query database");
				$m = mysqli_num_rows($result1);
			} else {
				$result1 = mysqli_query($conn, "select * from student where Email = '$email'")
						or die("Failed to query database");
				$m = mysqli_num_rows($result1);
			}
			
			if($m == 1){
				$result = mysqli_query($conn, "select * from users where email='$email'")
							or die("Failed to query database");
				$n = mysqli_num_rows($result);

				if($n == 1)
					$registered = 1;
				else
					$registered = 0;

				if($registered == 1)
					echo '<script>alert("User already registered under this email!")</script>';
				else
					header('Location: ./registration.php');
			} else {
				echo '<script>alert("Email not found in Record!")</script>';
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
	
	<?php include('templates/header.php') ?>

	<section class="container grey-text">
		<h4 class="center">Verification of Email</h4>
		<form class="white" action="verifyemail.php" method="POST">
	
			<label class="ftext">Your Email:</label>
			<input type="text" name="email" value="<?php echo $email ?>">
			<div class="right" id="errormessage">
				<?php
					echo $em_email;
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

			<div class="center" style="margin-top: 25px">
				<span class="ftext1">
					<input type="submit" name="check" value="verify" class="btn brand z-depth-0">
				</span>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php') ?>

</html>