<?php
		
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }

	session_start();

	$em_cid = "";
	$em_batch = "";


	
	$cid = [];
	$batch = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");

	$result = mysqli_query($conn, "select Course_ID,Course_Description from course")
						or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$temp = $row['Course_ID']." : ".$row['Course_Description'];
		array_push($cid,$temp);
	}

	$flag = 1;

	$i = 1;
	while($i <= 4){
		$temp = 'B'.$i;
		array_push($batch,$temp);
		$i++;
	}

	if(isset($_POST['submit'])){

			$flag = 1;
			$course = $bid = "";

			

			$index = 'btn';
			if(!empty($_POST[$index])){
				$course = $_POST[$index];
			} else
				$flag = 0;


			$index = 'btn2';
			if(!empty($_POST[$index])){
				$bid = $_POST[$index];
			} else
				$flag = 0;

			if($flag == 1){
				$arr2 = explode(':', $course);
				$course = $arr2[0];
				$cname = $arr2[1];
				// echo $bid, $course;
				$_SESSION['batch'] = $bid;
				$_SESSION['course'] = $course;
				$_SESSION['cname'] = $cname;
				header('Location: ./generatereport.php');
			}
	}

?>

<!DOCTYPE html>
<html>

	<style>
	* {
	  box-sizing: border-box;
	}

	.row {
	  display: flex;
	  margin-left:-5px;
	  margin-right:-5px;
	  width: 750px;
	}

	.column {
	  flex: 50%;
	  padding: 5px;
	}
	.table{
		border: 2px solid darkgray;
		color: grey;
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
					<li><a href="./mainpage.php" class="btn brand z-depth-0" style="margin-right: -45px;">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Choose Batch & Course</h4>

	<form style="margin-left: 280px" action="choosebatch.php" method="POST">
	<div class="row">
		<section class="column white container grey-text">
			<?php
			    echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '  <td class="table">Course </td>';
			    echo "</tr>";
			    $i = 0;
			    foreach($cid as $c){
			    	echo '<tr>
			    	<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo "<input type='radio' class='radio' name='btn' value='$c' id='btn.".$i."' />";
			    	echo '<label for="btn.'.$i.'">'.$c.'</label>';
			    	echo '</span>';
			    	echo '</td> </tr>';
			    	$i++;
			    }
			    echo '</table>';
			?>
		</section>
		<section class="column white container grey-text">
			<?php
			    echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '  <td class="table">Batch</td>';
			    echo "</tr>";
			    $i = 0;
			    foreach($batch as $b){
			    	echo '<tr>
			    	<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo "<input type='radio' class='radio' name='btn2' value='$b' id='btn2.".$i."' />";
			    	echo '<label for="btn2.'.$i.'">'.$b.'</label>';
			    	echo '</span>';
			    	echo '</td> </tr>';
			    	$i++;
			    }
			    echo '</table>';
			?>
		</section>
	</div>
	<div style="margin-left:160px">
		<span style="font-size: 18px ">
			<input type="submit" name="submit" value="CONTINUE" class="btn brand z-depth-0">
		</span>
	</div>
</form>

</html>