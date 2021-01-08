<?php
include("../../php/session.php");
include("../../standard.php");
include 'sidebar.php';
$user=$_SESSION['login_id'];

$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$ID=$row["ID"];
$sql = "select * from user where ID ='$ID'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

$picture=$row['Picture'];
$unit=$row['Unit'];
$name=$row['Name'];
if (empty($picture)) $picture = "../../img/profile.jpg"; 
else
$picture="../pic/".$picture;
$sql="SELECT * FROM user WHERE Unit='$unit' and LogINID!='$user'";
mysqli_query($db,"SET NAMES utf8mb4");
$result=mysqli_query($db,$sql);
$data=array();
while($row1=mysqli_fetch_assoc($result)){
	$data[]=array($row1['Name'],$row1['LogINID'],$row1['Type']);

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
	<link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<?php echo $sidebar;?>
	</div>
	<img src="../../img/c.png" class="imgg">
	<form action="member.php" method="post">
		<?php
			echo'<div class=" w3-text-blue" style="margin-right: 16%; margin-left: 20%; width:45%; margin-top:3%;">';
			echo '<table  style=" border-radius: 10px; background-image: linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff);" class="w3-table w3-bordered">';
			echo"<tr>";
			echo"<td><center><span  class='a'> </span></center></td>";
			echo"<td><center><span  class='a'> الحالة</span></center></td>";
			echo"<td><center><span  class='a'> الاسم</span></center></td>";
			echo"<td><center><span  class='a'> رقم العضو </span></center></td>";
			
			echo"</tr>";
			foreach ($data as $value) {
				echo"<tr>";
				echo"<td><span class='a'><button type='submit' name='show' value='$value[1]'class='w3-button w3-btn 'style='width: 100%; border-radius: 12%; margin-top: 5%; margin-left: 33%; background: white ;' >عرض</button></td>";
				echo"<td><center><span  class='a'> ";
				if($value[2]==='A')
					echo "فرد";
				elseif($value[2]=="D")
					echo "متوقف";
				else
					echo "قائد";				
				echo "</span></center></td>";
				echo"<td><center><span  class='a'> $value[0] </span></center></td>";
				echo"<td><center><span  class='a'> $value[1] </span></center></td>";
				
				echo"</tr>";

			}
			echo"</table></div>";
		?>
		<div class="bt">
			<a href="leader.php" ><button type="button" class="w3-button w3-btn " style=" border-radius: 10%; background: white ;" > الرجوع  </button></a>
		</div>
	</form>
	<?php echo $foot;?>
</body>
</html>