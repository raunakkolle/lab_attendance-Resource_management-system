<?php	
	$Log = [];
	$USN = [];
	$RID = [];
	$TS = [];
	$RTS = [];
	$Dept = [];
	
	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select * from resourceutilization")
				or die("Failed to query database");

	$n = mysqli_num_rows($result);

	$i = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$Log[$i] = $row['log_number'];
		$USN[$i] = $row['USN'];
		$RID[$i] = $row['Type_of_Resource'];
		$TS[$i] = $row['Borrowed_TS'];
		$RTS[$i] = $row['Returned_TS'];
		$i++;
	}

	$i = 0;
	foreach($RID as $item){
		$result = mysqli_query($conn, "select Name_of_Dept from resourcerecord where Type_of_Resource = '$item'")
				or die("Failed to query database");
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$dept[$i] = $row['Name_of_Dept'];
			$i++;
		}
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
	
	<?php include('../../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="../manageresource.php" class="btn brand z-depth-0" style="margin-right: -45px;">Click to Return</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Resource Usage Summary</h4>
	<section class="white container grey-text" style="width: 585px">
		<form class="white grey-text" action="resourceusage.php" method="POST" style="margin-left:-10px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Number</td>';
			    echo '<td class="table">Student USN</td>';
			    echo '<td class="table">Type of Resource</td>';
			    echo '<td class="table">Department</td>';
			    echo '<td class="table">Borrowed Time Stamp</td>';
			    echo '<td class="table">Returned Time Stamp</td>';
			    echo "</tr>";
			    $i = 0;
			    while($i < $n){
			    	echo '<tr>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $i+1;
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $USN[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $RID[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $dept[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $TS[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $RTS[$i];
			    	echo '</span>';
			    	echo '</td>';
			     	echo '</tr>';
			    	$i++;
			    }			  
			    echo '</table>';
			?>
        </form>
	</section>
</html>