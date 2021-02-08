<?php	
	$ID_arr = [];
	$Name_arr = [];
	$Email_arr = [];
	$Dept_arr = [];
	$Phone_arr = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select * from faculty")
				or die("Failed to query database");

	$n = mysqli_num_rows($result);

	$i = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$ID_arr[$i] = $row['Faculty_ID'];
		$Name_arr[$i] = $row['First_name']." ".$row['Last_name'];
		$Email_arr[$i] = $row['Email'];
		$Dept_arr[$i] = $row['Name_of_Dept'];
		$Phone_arr[$i] = $row['Phone_number'];
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
	
	<?php include('../../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="../userprofiles.php" class="btn brand z-depth-0" style="margin-right: -45px;">Click to Return</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Faculty List</h4>
	<section class="white container grey-text" style="width: 600px">
		<form class="white grey-text" action="facultylist.php" method="POST" style="margin-left:-10px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Faculty ID</td>';
			    echo '<td class="table">Faculty Name</td>';
			    echo '<td class="table">Faculty Email</td>';
			    echo '<td class="table">Department</td>';
			    echo '<td class="table">Phone Number</td>';
			    echo "</tr>";
			    $i = 0;
			    while($i < $n){
			    	echo '<tr>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $ID_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Name_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Email_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Dept_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Phone_arr[$i];
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