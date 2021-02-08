<?php
	session_start();
	$email = $_SESSION['varname'];
	$facultyid = "";
	$courseid = [];
	$date = "";

	$cid = $val_date = "";

	$em_cou = $em_date = "";

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select Faculty_ID from faculty where Email = '$email'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$facultyid = $row['Faculty_ID'];
	}

	$result = mysqli_query($conn, "select Course_ID from facultyincharge where Faculty_ID = '$facultyid'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$temp = $row['Course_ID'];
		if(!in_array($temp,$courseid)){
			array_push($courseid,$temp);
		}
	}

	$flag = 1;

	if(isset($_POST['submit'])){

		if(empty($_POST['cid'])){
			$em_cou = 'Enter Course_ID';
			$flag = 0;
		} else {
			$cid = $_POST['cid'];
			if(!in_array($cid,$courseid)){
				$em_cou = 'Enter a valid Course_ID';
				$flag = 0;
			}
		}

		if(empty($_POST['date'])){
			$em_date = "Enter date";
			$flag = 0;
		}
		else{
			$val_date = $_POST['date'];
		}

		if($flag == 1){
			$_SESSION['facultyid'] = $facultyid;
			$_SESSION['courseid'] = $cid;
			$_SESSION['date'] = $val_date;
			// echo $facultyid,$cid,$val_date;
			header('Location: ./summarylist.php');
		}
	}
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
		margin-left: 240px;
	}
	</style>
	
	<?php include('../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="./mainpage.php" class="btn brand z-depth-0">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Attendance Summary</h4>
	<form style="margin-left: 350px" action="attendancesummary.php" method="POST">
	<section class="white container grey-text" style="width: 600px">
			<table>

				<tr style="font-weight: bold; font-size: 17px">
				    <td class="table" style="width:50px">Faculty_ID</td>
				    <td class="table" style="width:100px">Course_ID</td>
				    <td class="table" style="width:100px">Date</td>
				</tr>

				<tr>
				    <td style="border: 2px solid darkgray"><input type="text" value="<?php echo $facultyid ?>" readonly></td>
				    
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

					<td class="table">
						<input type="date" name="date" value="<?php echo $val_date?>">
						<div id="errormessage">
							<?php
								echo $em_date;
							?>
						</div>
					</td>
				</tr>
			</table>
	</section>
	<br/>
		<div class="movecenter">
			<span class="ftext1">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</span>
		</div>
	</form>
	<?php include('../templates/footer.php') ?>

</html>