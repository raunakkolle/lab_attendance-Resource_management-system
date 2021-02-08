<?php
		
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }

	session_start();
	$department = $_SESSION['department'];
	// echo $department;

	$em_usn = "";
	$em_resourcetype = "";
	$em_checkbox = "";


	$usn =  "";
	$resourcetype = "";
	$checkbox = "";

	$type_array = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	$result = mysqli_query($conn, "select * from resourcerecord where Name_of_Dept = '$department'")
						or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$temp = $row['Type_of_Resource'];
		// echo $temp;
		array_push($type_array,$temp);
	}

	// echo $type_array;

	// foreach($type_array as $type)
	// 	echo $type;

	if(isset($_POST['submit'])){
		// echo htmlspecialchars($_POST['email']);
		// echo htmlspecialchars($_POST['password']);

		//check name
		if(empty($_POST['usn'])){
			$em_usn = 'A USN is required <br />';
		} else{
			$usn = $_POST['usn'];
			//validating usn
			if(!preg_match('/[a-zA-Z0-9\s]+$/', $usn)){
				$em_usn = 'USN must be alphanumeric only';
			}
		}

		if(empty($_POST['resourcetype'])){
			$em_resourcetype = 'A Resource Type has to be filled <br />';
		} else{
			$resourcetype = $_POST['resourcetype'];
			if(!in_array($resourcetype, $type_array)){
				$em_resourcetype = "Enter a type from the Resource List";
			}
		}

		if(empty($_POST['checkbox'])){
			$em_checkbox = "Select an Option"; 
		} else {
			$checkbox = $_POST['checkbox'];
		}

		if($em_usn == "" && $em_resourcetype == ""){
			// echo $usn,$resourcetype, $checkbox;
			$conn = mysqli_connect("localhost", "root", "","dbmsproject");
			$result1 = mysqli_query($conn, "select * from student where USN = '$usn'")
						or die("Failed to query database");
			$m = mysqli_num_rows($result1);
			if($m != 0){
				if($checkbox == "Borrowed"){
					$ts = date('d-m-y h:i:s');
					$result = mysqli_query($conn, "insert into resourceutilization values ('NULL','$usn',
					'$resourcetype','YES', '$ts', 'NULL', 'NULL')");
					if($result == True){
						echo '<script>
						alert("Successfully Updated Resource!");
						window.location.href="./updateresource.php";
						</script>';
					}
				} elseif ($checkbox == "Returned"){
					$result1 = mysqli_query($conn, "select * from resourceutilization where USN = '$usn' and 
						Type_of_Resource = '$resourcetype' and Borrowed = 'YES'");
					$number = mysqli_num_rows($result1);
					if($number != 0){
						$ts = date('d-m-y h:i:s');
						$result = mysqli_query($conn, "update resourceutilization set Returned = 'YES',Returned_TS = '$ts' 
						where USN = '$usn' and Type_of_Resource = '$resourcetype'");
						if($result == True){
							echo '<script>
							alert("Successfully Updated Resource!");
							window.location.href="./updateresource.php";
							</script>';
						}
					} else {
						echo '<script>
								alert("No Resource under this USN has been borrowed!");
								window.location.href="./updateresource.php";
								</script>';
								}
				}
			}
			else{
				echo '<script>
					alert("USN not found in records!");
					window.location.href="./updateresource.php";
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
	#section-right{
		float: right;
	}
	#section-left{
		margin-left: 100px;
		margin-top: 35px;
	}
	</style>
	
	<?php include('templates/header.php') ?>


	<h4 class="center grey-text">Enter Resource Details</h4>

	<section class="container grey-text" id="section-right">
		<form class="white" action="updateresource.php" method="POST">

			<label  style="font-size: 18px">USN:</label>
			<input type="text" name="usn">
			<div class="right" id="errormessage">
				<?php
					echo $em_usn;
				?>
			</div>
			<label  style="font-size: 18px">Type of Resource:</label>
			<input type="text" name="resourcetype">
			<div class="right" id="errormessage">
				<?php
					echo $em_resourcetype;
				?>
			</div>  
			<p class="ftext">Your Choice of Action:</p>
			  <input type="radio" id="Borrowed" name="checkbox" value="Borrowed">
			  <label for="Borrowed">Borrow</label><br>
			  <input type="radio" id="Returned" name="checkbox" value="Returned">
			  <label for="Returned">Return</label><br>
			 <div class="right" id="errormessage">
				<?php
					echo $em_checkbox;
				?>
			</div>   		
				
			<div class="center" style="margin-top: 25px">
				<span class="ftext1">
					<input type="submit" name="submit" value="submit" class="btn brand z-depth-0">
				</span>
			</div>
		</form>
	</section>

	<section class=" grey-text white" id="section-left" style="width:450px; font-size:18px">
		<p class="ftext center" style="font-size:18px">List of Resources Available:</p>
			  <?php
					$i = 1;
						foreach($type_array as $item){
							echo "<option value='strtolower($item)'>$i) $item</option>";
							$i++;
						}
				?>
	</section>

</html>