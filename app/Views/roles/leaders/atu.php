<?php
//conect to sission.php 
include("../../php/session.php");
include 'sidebar.php';
//retrieve from the database the name and picture for the current user to show them on the side par and the unit to select the user from the same unit 
$user=$_SESSION['login_id'];
$sql="select Name,Picture,Unit from user where LogINID=$user";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

$picture=$row['Picture'];
$unit=$row['Unit'];
$name=$row['Name'];

//set the default picture to the current user if he doesn't have set an one
if (empty($picture)) $picture = "../../img/profile.jpg"; 
else
$picture="../pic/".$picture;

//retrieve from the database the name and login id for the users in the leader unit who are members and assigned the data to array $data to use it in the form
$sql="SELECT * FROM user WHERE Unit='$unit' AND Type='A'";
$result=mysqli_query($db,$sql);
$data=array();
while($row1=mysqli_fetch_assoc($result)){
	$data[]=array($row1['Name'],$row1['LogINID']);

}
//check if the user request a submit or is visهt the page for the first time
If($_SERVER["REQUEST_METHOD"] == "POST"){

	//get the Login id for users who the leader check them as absent and order them in acceptable for SQL in clause
	if(isset($_POST['select'])){
		$today=date('Y-m-d');
	$arr=$_POST['select'];
		foreach($arr as $key=>$val){
			//write the sql statement to increase the attendance day count for the user who the leader check them as absent
			$sql="INSERT INTO attendance (date,loginid) VALUES('$today','$val')";
			$res=mysqli_query($db,$sql);
		}
	
	 header("location: leader.php");
	}
else header("location: leader.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Alquds Scout Group</title>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="../../css/body.css">
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
	<link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<?php echo $sidebar;?>
	</div>
	<img src="../../img/c.png" class="imgg">
	<form action="" method="post">
		<?php
			echo'<div class=" w3-text-blue" style="margin-right: 16%; margin-left: 20%; width:45%; margin-top:3%;">';
			echo '<table  style=" border-radius: 10px; background-image: linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff);" class="w3-table w3-bordered">';
			echo"<tr>";
			echo"<td><center><span  class='a'>الغائب </span></center></td>";
			echo"<td><center><span  class='a'> رقم العضو </span></center></td>";
			echo"<td><center><span  class='a'> الاسم</span></center></td>";
			echo"</tr>";
			foreach ($data as $value) {
				echo"<tr>";
				echo"<td><center><input class='w3-check' type='checkbox'name='select[]' value='$value[1]'></center></td>";
				echo"<td><center><span  class='a'> $value[0] </span></center></td>";
				echo"<td><center><span  class='a'> $value[1] </span></center></td>";
				echo"</tr>";

			}
			echo"</table></div>";
		?>
		<div class="bt">
			<input class="w3-button w3-btn bt1" type="submit" name="" value="حفظ " style=" background: white; border-radius: 10%;">
			<a href="leader.php" ><button type="button" class="w3-button w3-btn " style="border-radius: 10%; background: white ;" > الرجوع  </button></a>
		</div>
	</form>
	<?php echo $foot;?>
</body>
</html>