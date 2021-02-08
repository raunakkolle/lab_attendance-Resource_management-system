<?php	
	$USN_arr = [];
	$Name_arr = [];
	$Email_arr = [];
	$Dob_arr = [];
	$Sem_arr = [];
	$Phone_arr = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select * from student")
				or die("Failed to query database");

	$n = mysqli_num_rows($result);

	$i = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$USN_arr[$i] = $row['USN'];
		$Name_arr[$i] = $row['First_name']." ".$row['Last_name'];
		$Email_arr[$i] = $row['Email'];
		$Sem_arr[$i] = $row['Semester'];
		$Dob_arr[$i] = $row['Date_of_birth'];
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
	<h4 class="center grey-text">Student List</h4>
	<section class="white container grey-text" style="width: 700px">
		<form class="white grey-text" action="studentlist.php" method="POST" style="margin-left:5px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Student USN</td>';
			    echo '<td class="table">Student Name</td>';
			    echo '<td class="table">Student Email</td>';
			    echo '<td class="table">Semester</td>';
			    echo '<td class="table">Date of Birth</td>';
			    echo '<td class="table">Phone Number</td>';
			    echo "</tr>";
			    $i = 0;
			    while($i < $n){
			    	echo '<tr>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $USN_arr[$i];
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
			    	echo $Sem_arr[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Dob_arr[$i];
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