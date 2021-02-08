<?php
	session_start();
	$facultyid = $_SESSION['facultyid'];
	$courseid = $_SESSION['courseid'];
	$date = $_SESSION['date'];
	$time = "";


	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
	//query the database for users
	$result0 = mysqli_query($conn, "select time(time_stamp) as time from attendancedetails where Course_ID = '$courseid' and date(time_stamp) = '$date'") or die("Failed to query database");
	while($row = mysqli_fetch_array($result0, MYSQLI_ASSOC)){
		$time = $row['time'];
	}


	$result = mysqli_query($conn, "select * from attendancedetails where Course_ID = '$courseid' and date(time_stamp) = '$date'") or die("Failed to query database");
	$m = mysqli_num_rows($result);

	$result1 = mysqli_query($conn, "select * from attendancedetails where Course_ID = '$courseid' and date(time_stamp) = '$date'and Attendance_state = '1'") or die("Failed to query database");
	$n = mysqli_num_rows($result1);

?>

<!DOCTYPE html>
<html>

	<style>
	.table{
		border: 2px solid darkgray;
		color: grey;
		background-color: lightblue;
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
					<li id="back"><a href="./attendancesummary.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Attendance Summary</h4>
	<form style="margin-left: 350px" action="attendancesummary.php" method="POST">
	<section class="white container grey-text" style="width: 650px">
			<table>

				<tr style="font-weight: bold; font-size: 17px">
				    <td class="table" style="width:50px">Faculty_ID</td>
				    <td class="table" style="width:100px">Course_ID</td>
				    <td class="table" style="width:100px">Date</td>
				    <td class="table" style="width:100px">Time</td>
				    <td class="table" style="width:100px">Number Expected</td>
				    <td class="table" style="width:100px">Number Attended</td>
				</tr>

				<tr>
				    <td class="ftext" style="border: 2px solid darkgray"><?php echo $facultyid ?></td>
				    <td class="ftext" style="border: 2px solid darkgray"><?php echo $courseid ?></td>
				    <td class="ftext" style="border: 2px solid darkgray"><?php echo $date ?></td>
				    <td class="ftext" style="border: 2px solid darkgray"><?php echo $time ?></td>
				    <td class="ftext" style="border: 2px solid darkgray"><?php echo $m ?></td>
				    <td class="ftext" style="border: 2px solid darkgray"><?php echo $n ?></td>
				</tr>
			</table>
	</section>
	</form>
	<?php include('../templates/footer.php') ?>

</html>