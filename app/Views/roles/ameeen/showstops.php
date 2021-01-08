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
$name=$row['Name'];
$picture=$row['Picture'];
if (empty($picture)) $picture = "../../img/profile.jpg"; 
$picture="../pic/".$picture;
if(array_key_exists('submit', $_POST)){
	if(isset($_POST['stop'])){
	$keys=$_POST['stop'];
	$keys=implode(",",$keys);
	$sql="UPDATE user SET Type='A' WHERE LogINID in ($keys)";
	$res=mysqli_query($db,$sql);
}
	}
$req="select * from user where Type='D'";
mysqli_query($db,"SET NAMES utf8mb4");
$res=mysqli_query($db,$req);
if($res)
while($row1=mysqli_fetch_assoc($res)){
	$data[]=array($row1['LogINID'],$row1['Name'],$row1['Unit']);}
//print_r($data);

?>
<!DOCTYPE html>
<html>
<head>
	<title>Alquds Scout Group</title>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../../css/style.css">
	<link rel="stylesheet" href="in.css">
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
		echo'<div class=" w3-text-blue div-table3">';
		echo '<table  class="w3-table w3-bordered table1">';
		echo '<tr>';
		echo"<td><center><span  class='a'> تفعيل</span></center></td>";
		echo'<td><center><span  class="a">الوحددة</span></center></td>
		<td><center><span  class="a">الاسم</span></center></td>
		<td><center><span  class="a">رقم العضو</span></center></td>';
		echo'</tr>';
		if(isset($data))
		foreach ($data as $value) {
			echo"<tr>";
			echo"<td><center><span  class='a'><input class='w3-check d' type='checkbox' name='stop[]' value='$value[0]'></center></td>";
			echo"<td><center><span  class='a'>";
				echo $value[2];
			echo" </span></center></td>";
			echo"<td><center><span  class='a'> $value[1] </span></center></td>";
			echo"<td><center><span  class='a'> $value[0] </span></center></td>";
			echo"</tr>";

		}
		else{
			echo"<tr><td></td><td></td><td><center>ليس هناك أي فرد موقف حالياً</center></td><td></td></tr>";
		}
		echo"</table></div>";
		?>
		<button type="button" class="w3-button w3-btn " name="exit" style="width: 8%; border-radius: 10%;  margin-top: 5%; background: white ; margin-left: 36%;" onclick=location='./'; > رجوع  </button>

			<button type="submit" class="w3-button w3-btn " name="submit" value="" style="width: 8%; border-radius: 10%;  margin-top: 5%; background: white ; margin-left: 2%;" > اعتماد  </button>
			</form>
		<?php echo $foot;?>
</body>
</html>