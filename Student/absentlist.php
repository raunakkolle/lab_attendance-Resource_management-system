<?php

	session_start();
	$email = $_SESSION['varname'];

	$USN = "";

	$Log = [];
	$usn_arr = [];
	$cid = [];
	$ts = [];
	
	
	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select USN from student where Email = '$email'")
				or die("Failed to query database");
	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$USN = $row['USN'];
	}

	$result1 = mysqli_query($conn, "select * from attendancedetails where USN = '$USN' and Attendance_State ='0'")
				or die("Failed to query database");

	$n = mysqli_num_rows($result1);
	// echo $n;
	$i = 0;
	while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
		$Log[$i] = $i+1;
		$usn_arr[$i] = $row['USN'];
		$cid[$i] = $row['Course_ID'];
		$ts[$i] = $row['time_stamp'];
		$i++;
	}

?>

<!DOCTYPE html>
<html>
	
	<style>
		.table{
		border: 2px solid darkgray;
		color: grey;
		background-color: lightblue;
		}
		.movecenter{
		margin-left:160px !important;
		}
	</style>
	
	
	<?php include('../templates/header1.php') ?>
				<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li id="back"><a href="./viewsummary.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Absent Dates Summary</h4>
	<section class="white container grey-text" style="width: 450px">
		<form class="white grey-text" action="absentlist.php" method="POST" style="margin-left:-10px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Log Number</td>';
			    echo '<td class="table">Student USN</td>';
			    echo '<td class="table">Course ID</td>';
			    echo '<td class="table">Time Stamp</td>';
			    echo '<td class="table">Status</td>';
			    echo "</tr>";
			    $i = 0;
			    while($i < $n){
			    	echo '<tr>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Log[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $usn_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $cid[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $ts[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo "Absent";
			    	echo '</span>';
			    	echo '</td>';
			    	echo '</tr>';
			    	$i++;
			    }			  
			    echo '</table>';
			?> 
        </form>
	</section>

	
	<?php include('../templates/footer.php') ?>

</html>