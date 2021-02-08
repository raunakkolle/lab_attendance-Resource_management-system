<?php	
	$ID = [];
	$Credits = [];
	$Dept = [];
	$Desc = [];
	
	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select * from course")
				or die("Failed to query database");

	$n = mysqli_num_rows($result);

	$i = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$ID[$i] = $row['Course_ID'];
		$Credits[$i] = $row['Credits'];
		$Dept[$i] = $row['Name_of_Dept'];
		$Desc[$i] = $row['Course_Description'];
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
					<li><a href="../managecourse.php" class="btn brand z-depth-0" style="margin-right: -45px;">Click to Return</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Course List</h4>
	<section class="white container grey-text" style="width: 400px">
		<form class="white grey-text" action="courselist.php" method="POST" style="margin-left:-20px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Course ID</td>';
			    echo '<td class="table">Course Credits</td>';
			    echo '<td class="table">Department</td>';
			    echo '<td class="table">Course Description</td>';
			    echo "</tr>";
			    $i = 0;
			    while($i < $n){
			    	echo '<tr>';
			    	echo '<td style="border: 2px solid darkgray ">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $ID[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Credits[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Dept[$i];
			    	echo '</span>';
			    	echo '</td>';
			    	echo '<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo $Desc[$i];
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