<?php
		

	$em_susn = $em_eusn = "";

	$susn = $eusn = $course = $bid = "";

	$cid = [];
	$batch = [];

	$array_USN = [];

	$conn = mysqli_connect("localhost", "root", "","dbmsproject");

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
	while($i <= 4){
		$temp = 'B'.$i;
		array_push($batch,$temp);
		$i++;
	}

	if(isset($_POST['submit'])){

			$flag = 1;

			if(empty($_POST['susn'])){
			$em_susn = 'A Starting USN is required <br>';
			} else {
				$susn = $_POST['susn'];
				$flag = 0;
			}

			if(empty($_POST['eusn'])){
			$em_eusn = 'An Ending USN is required <br>';
			} else {
				$eusn = $_POST['eusn'];
				$flag = 0;
			}

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

			if($em_eusn == "" && $em_susn == ""){
				// echo $susn, $eusn, $course, $bid;
				$prefix = substr($susn, 0, 7);
				$eprefix = substr($eusn, 0, 7);
				// echo $prefix, $eprefix;
				if($prefix == $eprefix){
					$starting_num = intval(substr($susn, -3));
					$ending_num = intval(substr($eusn, -3));
					// echo $starting_num, $ending_num;
					if ($ending_num > $starting_num){
						$i = $starting_num;
						$n = $ending_num;
						while($i <= $n)
						{
							$numlength = strlen((string)$i);
							if($numlength == 1){
								$temp = $prefix."".'00'.$i;
								array_push($array_USN, $temp);
								$i++;
							}
							elseif($numlength == 2){
								$temp = $prefix."".'0'.$i;
								array_push($array_USN, $temp);
								$i++;
							}
							elseif($numlength == 3){
								$temp = $prefix."".$i;
								array_push($array_USN, $temp);
								$i++;
							}
						}
						$j = 0;
						while($j < count($array_USN))
						{
							$result = mysqli_query($conn, "select * from student where USN = '$array_USN[$j]'")
											or die("Failed to query database");
							$m = mysqli_num_rows($result);
							if ($m == 0)
								break;
							else
								$j++;
						}
						if($j == count($array_USN))
						{
								// echo substr($course,0,6), $bid;
								$course = substr($course, 0, 6);
								$temp = 0;
								while($temp < count($array_USN))
								{
									$conn = mysqli_connect("localhost", "root", "","dbmsproject");
									// echo $array_USN[$temp], $course, $bid;
									$result2 = mysqli_query($conn, "insert into courseattendance values ('$array_USN[$temp]',
											'$course','$bid')") or die("Failed to query database");
									$temp++;
								}
								if($temp == count($array_USN)){
									echo '<script>
										alert("Insertion into table successful");
										window.location.href="./assignstudent.php";
										</script>';
								}
						}
						else {
							echo '<script>
							alert("One or more USN have not been registered!Please Try Again");
							window.location.href="./assignstudent.php";
							</script>';
						}
					} else {
						echo '<script>
						alert("Ending USN cannot be lesser than Starting USN!Please Enter Again");
						window.location.href="./assignstudent.php";
						</script>';
					}
				} else {
					echo '<script>
						alert("The USN prefixes have to match!!Please Enter Again");
						window.location.href="./assignstudent.php";
						</script>';
				}
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
     #giveborder{
     	border: 2px solid darkgray;
     	padding: 25px;
     }
	</style>
	
	<?php include('../templates/header1.php') ?>
	<ul id="nav-mobile" class="right hide-on-small-and-down">
					<li><a href="./mainpage.php" class="btn brand z-depth-0" style="margin-right: -45px;">Click to Return</a></li>
				</ul>
			</div>
		</nav>

	<h4 class="center grey-text">Assign Student</h4>

	<form style="margin-left: 20px" action="assignstudent.php" method="POST">
	<div class="row">
		<div class="column white container grey-text" >
		<section style="padding:15px" id="giveborder">
				<label style="font-weight: bold; font-size: 17px">Starting USN:</label>
				<input type="text" name="susn" value="<?php echo $susn ?>">
				<div class="right" id="errormessage">
					<?php
						echo $em_susn;
					?>
				</div>
				<label style="font-weight: bold; font-size: 17px">Ending USN:</label>
				<input type="text" name="eusn" value="<?php echo $eusn ?>">
				<div class="right" id="errormessage">
					<?php
						echo $em_eusn;
					?>
				</div>
		</section>
		</div>
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
			<input type="submit" name="submit" value="ASSIGN" class="btn brand z-depth-0">
		</span>
	</div>
</form>

</html>