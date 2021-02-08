<?php
		
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }
	session_start();

	$em_dept = "";

	$department = "";
	
	if(isset($_POST['submit'])){

		if(empty($_POST['Department'])){
			$em_dept = "Choose a Department"; 
		} else {
			$department = $_POST['Department'];
		}

		if($em_dept == ""){

			$_SESSION['department'] = $department;

			echo $department;

			header('Location: ./updateresource.php');

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
		<h4 class="center">Choose Department</h4>
		<form class="white" action="choosedepartment.php" method="POST">

  
  			<p class="ftext">Choose Department:</p>
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
    		
			<div class="center" style="margin-top: 25px">
				<span class="ftext1">
					<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
				</span>
			</div>
		</form>
	</section>

	<?php include('templates/footer.php') ?>

</html>