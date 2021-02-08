<?php
	session_start();
	$bid = $_SESSION['batch'];
	$courseid = $_SESSION['course'];
	$cname = $_SESSION['cname'];

	$USN = [];

	$Log = [];
	$m_arr = $n_arr = $p_arr = [];
	$status_arr = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select USN from courseattendance where Batch_ID = '$bid'")
				or die("Failed to query database");
	
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		$temp = $row['USN'];
		if(!in_array($temp, $USN))
		{
			array_push($USN, $temp);
		}
	}

	$size = count($USN);


	$i = 0;
	foreach($USN as $item){
		$result = mysqli_query($conn, "select * from attendancedetails where Course_ID = '$courseid' and USN = '$item'")
				or die("Failed to query database");
		$m = mysqli_num_rows($result);
		$result1 = mysqli_query($conn, "select * from attendancedetails where Course_ID = '$courseid' and USN = '$item'
							and Attendance_state = '1'") or die("Failed to query database");
		$n = mysqli_num_rows($result1);
		$Log[$i] = $i+1;
		$m_arr[$i] = $m;
		$n_arr[$i] = $n;
		if($m != 0){
			$p_arr[$i] = number_format(floor($n*100)/$m,3, '.', '');
		}
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
					<li id="back"><a href="./choosebatch.php" class="btn brand z-depth-0">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Report</h4>
	<div class="center" style="text-align: center; font-size: 17px; color:darkgray !important">
			<span>Course ID:</span>
			<?php echo $courseid ?><br/>
			<span>Course Name:</span>
			<?php echo $cname ?><br/>
			<span>Batch ID:</span>
			<?php echo $bid ?>

	</div>
	<section class="white container grey-text" style="width: 560px">
		<form class="white grey-text" action="generatereport.php" method="POST" style="margin-left:-10px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Log Number</td>';
			    echo '<td class="table">USN</td>';
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
			    	echo $USN[$i];
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