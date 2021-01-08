<?php
include("../../php/session.php");
include("../../standard.php");
include("sidebar.php");
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
else $picture="../pic/".$picture;
$req="select * from steprequst";
mysqli_query($db,"SET NAMES utf8mb4");
$res=mysqli_query($db,$req);
while($row1=mysqli_fetch_assoc($res)){
	$data[]=array($row1['ID'],$row1['name'],$row1['unit'],$row1['jobinunit'],$row1['date'],$row1['reason']);}
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
	<form action="stop.php" method="post">
		<?php
		echo'<div class=" w3-text-blue div-table3">';
		echo '<table  class="w3-table w3-bordered table1">';
		echo '<tr>';
		echo"<td></td>";
		echo'<td><center><span  class="a">تاريخ الطلب</span></center></td>
		<td><center><span  class="a">العمل داخل الوحدة</span></center></td>
		<td><center><span  class="a">الوحدة</span></center></td>
		<td><center><span  class="a">اسم صاحب الطلب</span></center></td>
		<td><center><span  class="a">رقم الطلب </span></center></td>';
		echo'</tr>';
		if(isset($data))
		foreach ($data as $value) {
			echo"<tr>";
			echo"<td><span class='a'><button type='submit' name='id' value='$value[0]'class='w3-button w3-btn 'style='width: 100%; border-radius: 12%; margin-top: 5%; margin-left: 33%; background: white ;' >عرض الطلب</button></td>";
			//echo"<td><center><span  class='a'> $value[5] </span></center></td>";
			echo"<td><center><span  class='a'> $value[4] </span></center></td>";
			echo"<td><center><span  class='a'> $value[3] </span></center></td>";
			echo"<td><center><span  class='a'> $value[2] </span></center></td>";
			echo"<td><center><span  class='a'> $value[1] </span></center></td>";
			echo"<td><center><span  class='a'> $value[0] </span></center></td>";
			echo"</tr>";

		}
		else{	
			echo"<tr><td></td><td></td><td></td><td><center>ليس هناك أي طلب توقف جديد</center></td><td></td></tr>";
		}
		echo"</table></div>";
		?>
		<div class="bt">
			<a href="./" ><button type="button" class="w3-button w3-btn " style="border-radius: 10%; background: white ;" > الرجوع  </button></a>
		</div>

	</form>
	<?php echo $foot;?>
</body>
</html>