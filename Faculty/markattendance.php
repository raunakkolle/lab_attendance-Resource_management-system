<?php
	//connect to database
	//$conn = mysqli_connect()
	session_start();
	$email = $_SESSION['varname'];
	$facultyname = "";
	$facultyid = "";
	$semester = [];
	$courseid = [];
	$batchid = [];
	$emsg_sem = $em_cou = $em_bat = $em_date = $em_time =  "";
	$sem = "";
	$cid = $bid = $val_date = $val_time = "";
	$flag = 1;

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select Faculty_ID,First_name,Last_name from faculty where Email = '$email'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$facultyid = $row['Faculty_ID'];
		$facultyname = $row['First_name']." ".$row['Last_name'];
	}

	$result = mysqli_query($conn, "select Semester,Course_ID,Batch_ID from facultyincharge where Faculty_ID = '$facultyid'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$temp = $row['Semester'];
		if(!in_array($temp,$semester)){
			array_push($semester,$temp);
		}
		$temp = $row['Course_ID'];
		if(!in_array($temp,$courseid)){
			array_push($courseid,$temp);
		}
		$temp = $row['Batch_ID'];
		if(!in_array($temp,$batchid)){
			array_push($batchid,$temp);
		}
	}

	

	if(isset($_POST['submit'])){
		//check for semester
		if(empty($_POST['sem'])){
			$emsg_sem = 'Enter Semester';
			$flag = 0;
		} else {
			$sem = $_POST['sem'];
			if(!in_array($sem,$semester)){
				$emsg_sem = 'Enter a valid Semester';
				$flag = 0;
			}
			else
				$flag = 1;
		}
		//check for courseid
		if(empty($_POST['cid'])){
			$em_cou = 'Enter Course_ID';
			$flag = 0;
		} else {
			$cid = $_POST['cid'];
			if(!in_array($cid,$courseid)){
				$em_cou = 'Enter a valid Course_ID';
				$flag = 0;
			}
			else
				$flag = 1;
		}
		//check for batchid
		if(empty($_POST['bid'])){
			$em_bat = "Enter Batch_ID";
			$flag = $flag && 0; 
		} else {
			$bid = $_POST['bid'];
			if(!in_array($bid,$batchid)){
				$em_bat = "Enter a valid Batch_ID";
				$flag = $flag && 0;
			}
			else
				$flag = 1;
		}

		//check for date
		if(empty($_POST['date'])){
			$em_date = "Enter date";
			$flag = 0;
		}
		else{
			$val_date = $_POST['date'];
			$flag = 1;
		}

		//check for time
		if(empty($_POST['time'])){
			$em_time = "Enter time";
			$flag = 0;
		}
		else{
			$val_time = $_POST['time'];
			$flag = 1;
		}


		if($flag == 1){
			// echo $sem,$cid,$bid,$val_date,$val_time;

			$_SESSION['sem'] = $sem;
			$_SESSION['cid'] = $cid;
			$_SESSION['bid'] = $bid;
			$_SESSION['date'] = $val_date;
			$_SESSION['time'] = $val_time;
			header('Location: ./attendancelist.php');
		}

	} //end of post isset

?>

<!DOCTYPE html>
<html>
	
	<style>
	table,tr{
		border: 2px solid darkgray;
	}
	.table{
		border: 2px solid darkgray;
		color: grey;
	}
	.border{
		border: 2px solid darkgray;
	}
	.movecenter{
		margin-left:550px !important;
	}
	</style>
	
	<?php include('../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="./mainpage.php" class="btn brand z-depth-0">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Attendance Registry</h4>
	<br/>
	<form style="margin-left: 20px" action="markattendance.php" method="POST">
	<section class="white container grey-text" style="width: 1275px">
		<!-- <form class="white" action="markattendance.php" method="POST"> -->
			<!-- <label class="ftext">Faculty_ID:</label>
			<input type="text" value="<?php echo $facultyid ?>" readonly>
			<label class="ftext">Faculty Name:</label>
			<input type="text" value="<?php echo $facultyname ?>" readonly> -->
			<table>

				<tr style="font-weight: bold; font-size: 17px">
				    <td class="table" style="width:50px">Faculty_ID</td>
				    <td class="table" style="width:100px">Faculty_Name</td>
				    <td class="table">Faculty_Email</td>
				    <td class="table">Semester</td>
				    <td class="table">Course_ID</td>
				    <td class="table">Batch_ID</td>
				    <td class="table">Date</td>
				    <td class="table">Time</td>
				</tr>

				<tr>
				    <td style="border: 2px solid darkgray"><input type="text" value="<?php echo $facultyid ?>" readonly></td>
				    <td class="table"><input type="text" value="<?php echo $facultyname ?>" readonly></td>
				    <td class="table"><input type="text" value="<?php echo $email ?>" readonly></td>

				    
					<td class="table ftext1">

						<option selected="selected">Choose Semester:</option>
						<?php
							$i = 1;
								foreach($semester as $item){
									echo "<option value='strtolower($item)'>$i) $item</option>";
								}
						?>
						<br/>

						<input class="border" name="sem" value="<?php echo $sem?>">
			            <div id="errormessage">
							<?php
								echo $emsg_sem;
							?>
						</div>
					</td>

					<td class="table ftext1">

						<option selected="selected">Choose Course_ID:</option>
						<?php
							$i = 1;
								foreach($courseid as $item){
									echo "<option value='strtolower($item)'>$i) $item</option>";
								}
						?>
						<br/>

						<input class="border" name="cid" value="<?php echo $cid?>">
			            <div id="errormessage">
							<?php
								echo $em_cou;
							?>
						</div>
					</td>

					<td class="table ftext1">
						<option selected="selected">Choose Batch_ID:</option>
						<?php
							$i = 1;
								foreach($batchid as $item){
									echo "<option value='strtolower($item)'>$i) $item</option>";
									$i++;
								}
						?>
						<input class="border" name="bid" value="<?php echo $bid?>">
			            <div id="errormessage">
							<?php
								echo $em_bat;
							?>
						</div>
					</td>

					<td class="table">
						<input type="date" name="date" value="<?php echo $val_date?>">
						<div id="errormessage">
							<?php
								echo $em_date;
							?>
						</div>
					</td>
				    <td class="table">
				    	<input type="time" name="time" value="<?php echo $val_time?>">
				    	<div id="errormessage">
							<?php
								echo $em_time;
							?>
						</div>
				    </td>
				</tr>
			</table>
	</section>
	<br/>
		<div class="movecenter">
			<span class="ftext1">
				<?php $em_sem = $em_cou = $em_bat = ""; ?>
				<input type="submit" name="submit" value="Confirm" class="btn brand z-depth-0">
			</span>
		</div>
	</form>
	<?php include('../templates/footer.php') ?>

</html>