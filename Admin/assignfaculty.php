<?php
		
	// if(isset($_GET['submit'])){
	// 	echo $_GET['email'];
	// 	echo $_GET['password'];
	// }

	session_start();

	$em_fname = "";
	$em_cid = "";
	$em_sem = "";
	$em_batch = "";


	$fname = [];
	$cid = [];
	$sem = [];
	$batch = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");

	$result = mysqli_query($conn, "select Faculty_ID, First_name, Last_name from faculty")
						or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$temp = $row['Faculty_ID']." - ".$row['First_name']." ".$row['Last_name'];
		array_push($fname,$temp);
	}

	// foreach($fname as $type)
	// 	echo $type;

	$result = mysqli_query($conn, "select Course_ID,Course_Description from course")
						or die("Failed to query database");

	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$temp = $row['Course_ID']." : ".$row['Course_Description'];
		array_push($cid,$temp);
	}

	$flag = 1;

	$i = 1;
	while($i <= 8){
		array_push($sem, $i);
		$i++;
	}
	$i = 1;
	while($i <= 4){
		$temp = 'B'.$i;
		array_push($batch,$temp);
		$i++;
	}

	if(isset($_POST['submit'])){

			$flag = 1;
			$faculty = $course = $semester = $bid = "";

			$index = 'btn0';
			if(!empty($_POST[$index])){
				$faculty = $_POST[$index];
			} else
				$flag = 0;

			$index = 'btn';
			if(!empty($_POST[$index])){
				$course = $_POST[$index];
			} else
				$flag = 0;

			$index = 'btn1';
			if(!empty($_POST[$index])){
				$semester = $_POST[$index];
			} else
				$flag = 0;

			$index = 'btn2';
			if(!empty($_POST[$index])){
				$bid = $_POST[$index];
			} else
				$flag = 0;

			if($flag == 1){
				$arr1 = explode('-', $faculty);
				$arr2 = explode(':', $course);
				$faculty = $arr1[0];
				$course = $arr2[0];
				//echo $faculty, $course, $semester, $bid;
				$result = mysqli_query($conn, "insert into facultyincharge values (NULL,'$faculty',
					'$semester','$course','$bid')");
				if($result == True)
				{
					echo '<script>
					alert("Insertion Succesful!");
					window.location.href="./mainpage.php";
					</script>';
				}
			} else {
				echo '<script>
					alert("One or more entries have not been selected!");
					window.location.href="./assignfaculty.php";
					</script>';
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
	  width: 1250px;
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

	<h4 class="center grey-text">Assign Faculty</h4>

	<form style="margin-left: 20px" action="assignfaculty.php" method="POST">
	<div class="row">
		<section class="column white container grey-text">
			<?php
            	echo "<table>";
			    echo '<tr style="font-weight: bold; font-size: 17px">';
			    echo '  <td class="table">Faculty Name</td>';
			    echo "</tr>";
			    $i = 0;
			    foreach($fname as $f){
			    	echo '<tr>
			    	<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo "<input type='radio' class='radio' name='btn0' value='$f' id='btn0.".$i."' />";
			    	echo '<label for="btn0.'.$i.'">'.$f.'</label>';
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
			    echo '  <td class="table">Semester</td>';
			    echo "</tr>";
			    $i = 0;
			    foreach($sem as $s){
			    	echo '<tr>
			    	<td style="border: 2px solid darkgray">';
			    	echo '<span class="ftext" style="color:gray">';
			    	echo "<input type='radio' class='radio' name='btn1' value='$s' id='btn1.".$i."' />";
			    	echo '<label for="btn1.'.$i.'">'.$s.'</label>';
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
			<input type="submit" name="submit" value="ASSIGN" class="btn brand z-depth-0">
		</span>
	</div>
</form>

</html>