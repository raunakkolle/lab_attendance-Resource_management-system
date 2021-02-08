<?php
	session_start();
	$email = $_SESSION['varname'];

	$USN = "";

	$courseid = [];
	$Log = [];
	$m_arr = $n_arr = $p_arr = [];
	$status_arr = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select USN from student where Email = '$email'")
				or die("Failed to query database");
	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$USN = $row['USN'];
	}

	$result1 = mysqli_query($conn, "select Course_ID from courseattendance where USN = '$USN'")
				or die("Failed to query database");

	while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
		array_push($courseid, $row['Course_ID']);
	}

	$size = count($courseid);

	$i = 0;
	foreach($courseid as $item){
		$result = mysqli_query($conn, "select * from attendancedetails where Course_ID = '$item' and USN = '$USN'")
				or die("Failed to query database");
		$m = mysqli_num_rows($result);
		$result1 = mysqli_query($conn, "select * from attendancedetails where Course_ID = '$item' and USN = '$USN'
							and Attendance_state = '1'") or die("Failed to query database");
		$n = mysqli_num_rows($result1);
		$Log[$i] = $i+1;
		$m_arr[$i] = $m;
		$n_arr[$i] = $n;
		if($m != 0)
			$p_arr[$i] = ($n/$m)*100;
		else
			$p_arr[$i] = 0;
		if($p_arr[$i] > 85)
			$status_arr[$i] = "Good";
		else if($p_arr[$i] == 85)
			$status_arr[$i] = "Border";
		else {
			if($m != 0)
				$status_arr[$i] = "Shortage";
			else
				$status_arr[$i] = "NULL";
		}
		// echo $i,$status_arr[$i];
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

	<h4 class="center grey-text">Consolidated Summary</h4>
	<section class="white container grey-text" style="width: 530px">
		<form class="white grey-text" action="consolidatedlist.php" method="POST" style="margin-left:-10px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Log Number</td>';
			    echo '<td class="table">Course ID</td>';
			    echo '<td class="table">Labs Conducted</td>';
			    echo '<td class="table">Labs Attended</td>';
			    echo '<td class="table">Percentage</td>';
			    echo '<td class="table">Status</td>';
			    echo "</tr>";
			    $i = 0;
			    while($i < $size){
			    	echo '<tr>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Log[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $courseid[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $m_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $n_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $p_arr[$i]."%";
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="font-style: italic;">';
			    	if($status_arr[$i] == "Good")
			    		echo '<span style="color:green">';
			    	elseif($status_arr[$i] == "Border")
			    		echo '<span style="color:yellow">';
			    	elseif($status_arr[$i] == "Shortage")
			    		echo '<span style="color:red">';
			    	else
			    		echo '<span style="color:blue">';
			    	echo $status_arr[$i];
			    	echo '</span>';
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