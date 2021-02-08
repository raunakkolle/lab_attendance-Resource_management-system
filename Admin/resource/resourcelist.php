<?php


	session_start();
	$department = $_SESSION['department'];

	$Type_arr = [];
	
	$conn = mysqli_connect("localhost", "root", "","dbmsproject");
	
			//query the database for users
	$result = mysqli_query($conn, "select * from resourcerecord where Name_of_Dept = '$department'")
				or die("Failed to query database");

	$n = mysqli_num_rows($result);

	$i = 0;
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$Type_arr[$i] = $row['Type_of_Resource'];
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
					<li><a href="../manageresource.php" class="btn brand z-depth-0" style="margin-right: -45px;">Click to Return</a></li>
				</ul>
			</div>
		</nav>
	<h4 class="center grey-text">Resource List</h4>
	<section class="white container grey-text" style="width: 400px">
		<form class="white grey-text" action="resourcelist.php" method="POST" style="margin-left:-10px">
            <?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '<td class="table">Sl.No</td>';
			    echo '<td class="table">Resource Type</td>';
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
			    	echo $Type_arr[$i];
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