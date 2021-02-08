<?php
	session_start();
	$semester = $_SESSION['sem'];
	$courseid = $_SESSION['cid'];
	$batchid = $_SESSION['bid'];
	$date = $_SESSION['date'];
	$time = $_SESSION['time'];
	$course_name = "";
	$timestamp = $date." ".$time;

	// echo $date." ".$time;

	// echo $semester,$courseid,$batchid,$date,$time;

 	$student_list = [];
 	$attendance_list = [];
	$conn = mysqli_connect("localhost", "root", "","dbmsproject");

	$result = mysqli_query($conn, "select Course_Description from course where Course_ID = '$courseid'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$course_name = $row['Course_Description'];
	}
	
			//query the database for users
	$result = mysqli_query($conn, "select USN from courseattendance where Course_ID = '$courseid' and Batch_ID = '$batchid'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$usn = $row['USN'];
		array_push($student_list,$usn);
	}

	$n = count($student_list);

	if(isset($_POST['submit'])){
		// echo "hello";
		$i = 0;
		while($i < $n){
			$index = 'btn'.$i;
			if(!empty($_POST[$index])){
				$radio_val = $_POST[$index];
				if(!strcmp($radio_val,"Present"))
					array_push($attendance_list,1);
				else
					array_push($attendance_list,0);
			}
			else{
				break;
			}
			$i++;
		}
		if($i != $n){
			echo '<script>alert("Alert!!One or more entries have not been chosen")</script>';
		}
		else{
			for($i=0;$i<$n;$i++){
				// echo $student_list[$i],$attendance_list[$i];

				$result = mysqli_query($conn, "insert into attendancedetails values (NULL,'$attendance_list[$i]',
					'$student_list[$i]','$courseid','$timestamp')");
				if($result == False){
					break;
				}

			}
			if($i == $n){
				echo '<script>
					alert("Insertion into table successful");
					window.location.href="./mainpage.php";
					</script>';
			}
			else{
				echo '<script>alert("Unexpected Error!!")</script>';
			}
		}
	}

?>

<!DOCTYPE html>
<html>

	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	</head>

	<style>
		.table{
		border: 2px solid darkgray;
		color: grey;
		}
		.movecenter{
		margin-left:160px !important;
		}
		input[type=radio],
        input.radio {
          float: left;
          clear: none;
          margin: 2px 0 0 2px;
        }
	</style>
	
	<?php include('../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="./mainpage.php" class="btn brand z-depth-0" style="margin-right: -45px;">Back to Home Page</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Student Attendance List</h4>
	<div class="center" style="text-align: center; font-size: 17px; color:darkgray !important">
			<span>Course ID:</span>
			<?php echo $courseid ?><br/>
			<span>Course Name:</span>
			<?php echo $course_name ?><br/>
			<span>Semester:</span>
			<?php echo $semester ?><br/>
			<span>Batch ID:</span>
			<?php echo $batchid ?>

	</div>
	<div class="container grey-text">
	<form class="white grey-text" action="attendancelist.php" method="POST">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '  <td class="table">Student USN</td>';
			    echo '        <td class="table">Present</td> ';
			    echo '        <td class="table">Absent</td>';
			    echo "    </tr>";
			    $i = 0;
			    foreach($student_list as $usn){
			    	echo '<tr>
			    	<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $usn;
			    	echo '</span>';
			    	echo '</td>';
			    	
			    	echo '<td class="table">';
			    	echo "<input type='radio' class='radio' name='btn".$i."' value='Present' id='x.".$i."' />";
			    	echo '<label for="x.'.$i.'"></label>';
			    	echo '</td> ';
			    	echo '<td class="table">';
			    	echo "<input type='radio' class='radio' name='btn".$i."' value='Absent' id='y.".$i."' />";
			    	echo '<label for="y.'.$i.'"></label>';
			    	echo '</td> ';
			    	$i++;
			    }			    
			    echo '</table>';
			?>
			<br/>
			<span class="ftext1 movecenter">
				<input type="submit" name="submit" value="Confirm" class="btn brand z-depth-0">
			</span>
        </form>
	</div>
</html>