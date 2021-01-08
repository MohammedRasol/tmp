<?php
include("../../php/session.php");
include("../../standard.php");
include('sidebar.php');
$user=$_SESSION['login_id'];
unset($_SESSION['Dunit']);
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
$add=$row['Address'];
$super=$row['Super'];
$join=$row['JoinDate'];
$barth=$row['BarthDate'];
$relatev=$row['Relatev'];
$phone=$row['Phone'];
$email=$row['Email'];

if (empty($picture)) $picture = "../../img/profile.jpg";
else
$picture="../pic/".$picture;

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


	<img src="../../img/c.png"class="imgg">
	<form action="delete1.php" method="post">
		<div  style="">
			<select class="c" style="border:1px;direction: rtl; width:18%; margin-left: 33%; margin-top: 5%;" name="fuint" required>
				 <option value="" disabled selected> الوحدة التي تريد الحذف منها  </option>
	  			<option value="1" >الأشبال   </option>
				<option value="2">الكشاف   </option>
				<option value="3">المتقدم   </option>
				<option value="4">الجوال    </option>
				<option value="5">القادة    </option>
			</select>
		</div>
		<button type="submit" name="Del" class="w3-button w3-btn " style="width: 10%; border-radius: 12%; margin-top: 5%; margin-left: 33%; background: white ;" > عرض اعضاء الوحدة </button>
		<a href="./" ><button type="button" class="w3-button w3-btn " style="width: 8%; border-radius: 10%;  margin-top: 5%; background: white ;" > الغاء  </button></a>
	</form>
	<?php echo $foot;?>
	</body>
	</html>