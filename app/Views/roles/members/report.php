<?php
include("../../php/session.php");
include("../../standard.php");
include("sidebar.php");
if(!isset($_SESSION['login_id']))
header('../../login/login.php');
$user=$_SESSION['login_id'];

$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_array($result);
$ID=$row["ID"];
$sql = "select * from user where ID ='$ID'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_array($result);
$name=$row['Name'];
$picture=$row['Picture'];
if (empty($picture)) $picture = "../../img/profile.jpg"; 
$picture="../pic/".$picture;
$rep=$row['Document'];
$sql="SELECT * FROM `attendance` WHERE loginid='$user'";
$result=mysqli_query($db,$sql);
$count=mysqli_num_rows($result)

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
	<link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<a href="att.php" class="w3-bar-item w3-button w3-text-blue b w3-right-align"> <?php echo $count;?>: أيام الغياب  </a>
		<?php echo $sidebar; ?>
	</div>
	<img src="../../img/c.png" class="imgg">
		<div style="direction: rtl; background-image: linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff); margin-left: 27%; margin-top:5%; width: 35%; height: 40%; font-size: 130%;opacity: 0.8;  padding: 2%; border-radius: 10%;">

		<center>

			<b>
				<p >
					تقرير القائد

				</p>

			</b>

		</center>

		<p>

			<?php echo $rep;?>

		</p>

	</div>
	<div class="bt">
		<a href="member.php"><button type="button" class="w3-button w3-btn edit1" style="border-radius: 10%; background: white ;" > الرجوع </button></a>
	</div>
	<?php echo $foot;?>
</body>
</html>