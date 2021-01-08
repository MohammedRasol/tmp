<?php
include("../../php/session.php");
include("../../standard.php");
include 'sidebar.php';
if(!isset($_SESSION['login_id']))
header('../../login/login.php');

$user=$_SESSION['login_id'];

$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$ID=$row["ID"];
$sql = "select * from user where ID ='$ID'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

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

$sql="SELECT * FROM `attendance` WHERE loginid='$user'";
$result=mysqli_query($db,$sql);
$count=mysqli_num_rows($result);
while($row = mysqli_fetch_assoc($result)){
    $data[]=$row['date'];
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
	<link rel="stylesheet" href="in.css">
	<link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="../../css/body.css">
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<a href="member.php" class="w3-bar-item w3-button w3-text-blue b w3-right-align"> <?php echo $count;?>: أيام الغياب  </a>
		<?php echo $sidebar; ?>
	</div>
	<img src="../../img/c.png" class="imgg">
	<form action="" method="POST" enctype="multipart/form-data">
		
        <?php
			echo'<div class=" w3-text-blue" style="margin-right: 16%; margin-left: 20%; width:45%; margin-top:3%;">';
			echo '<table  style=" border-radius: 10px; background-image: linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff);" class="w3-table w3-bordered">';
			echo"<tr>";
			echo"<td><center><span  class='a'> تاريخ الغياب </span></center></td>";
			echo"<td><center><span  class='a'> غياب رقم</span></center></td>";
            echo"</tr>";
            $num=1;
            if($count!=0)
			foreach ($data as $value) {
				echo"<tr>";
				echo"<td><center><span  class='a'> $value </span></center></td>";
				echo"<td><center><span  class='a'> $num </span></center></td>";
				echo"</tr>";
                $num++;
            }
            echo "<tr>";
            if($count<=2)
            echo"<td><center><span  class='a'>منتظم</span></center></td>";
            elseif($count>2&&$count<=4)
            echo"<td><center><span  class='a'>أنذار أول</span></center></td>";
            elseif($count>4)
            echo"<td><center><span  class='a'>أنذار ثاني</span></center></td>";
            elseif($count>5)
            echo"<td><center><span  class='a'>أنذار نهائي</span></center></td>";
            echo "<td><center><span  class='a'>وضع الفرد</span></center></td></tr>";
			echo"</table></div>";
		?>
		<div class="bt">
		<button type="button" class="w3-button w3-btn " name="exit" style=" border-radius: 10%; background: white ; " onclick=location='member.php'; > رجوع  </button>
		</div>
	</form>
	<?php echo $foot;?>
	
	<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="j.js"></script>
	<script src="custom-file-input.js"></script>
</body>
</html>