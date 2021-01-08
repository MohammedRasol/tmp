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
$name=$row['Name'];
if (empty($picture)) $picture = "../../img/profile.jpg";
else
$picture="../pic/".$picture;

if($_POST['fuint']=='6')
{
	$sql="SELECT * FROM user WHERE LogINID <> '$user'";
}else{
$unit=$A[$_POST['fuint']];
$sql="SELECT * FROM user WHERE Unit='$unit' AND LogINID <> '$user'";}
mysqli_query($db,"SET NAMES utf8mb4");
$result=mysqli_query($db,$sql);
$data=array();
while($row1=mysqli_fetch_assoc($result)){
	$data[]=array($row1['Name'],$row1['LogINID'],$row1['Address'],$row1['Unit'],$row1['Phone'],$row1['Email'],$row1['Type'],$row1['nationalID']);

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
	<link rel="stylesheet" type="text/css" href="in.css" />
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
		echo'<div class=" w3-text-blue div-table3">';
		echo '<table  class="w3-table w3-bordered table1">';
		echo '<tr><td><center><span  class="a">البريد الالكتروني</span></center></td>
		<td><center><span  class="a">رقم الهاتف  </span></center></td>
		<td><center>الحالة</center></td>
		<td><center><span  class="a">الوحدة </span></center></td>

		<td><center><span  class="a">العنوان </span></center></td>
		<td><center><span  class="a">رقم العضو </span></center></td>
		<td><center><span  class="a">الرقم الوطني  </span></center></td>
		<td><center><span  class="a">الاسم  </span></center></td>';
		echo'</tr>';
		foreach ($data as $value) {
			echo"<tr>";
			echo"<td><center><span  class='a'> $value[5] </span></center></td>";
			echo"<td><center><span  class='a'> $value[4] </span></center></td>";
			if($value[6]==='A')
				echo"<td><center><span  class='a'> فرد</span></center></td>";
			elseif ($value[6]==='D') {
				echo"<td><center><span  class='a'> متوقف</span></center></td>";
			}
			else
				echo"<td><center><span  class='a'> قائد</span></center></td>";
			echo"<td><center><span  class='a'> $value[3] </span></center></td>";
			echo"<td><center><span  class='a'> $value[2] </span></center></td>";
			echo"<td><center><span  class='a'> $value[1] </span></center></td>";
			echo"<td><center><span  class='a'> $value[7] </span></center></td>";
			echo"<td><center><span class='a'>$value[0]</spen><center></td>";
			echo"</tr>";

		}
		echo"</table></div>";
		?>
		<div class="bt">
		<a href="show.php" ><button type="button" class="w3-button w3-btn " style="border-radius: 10%; background: white ;" > الرجوع  </button></a>
		</div>

	</form>
</body>
 <?php echo $foot;?>
</html>