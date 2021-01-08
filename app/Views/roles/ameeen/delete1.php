<?php
include("../../php/session.php");
include("../../standard.php");
include("sidebar.php");
$user=$_SESSION['login_id'];
if(array_key_exists("Del",$_POST))
	$_SESSION['Dunit']=$_POST['fuint'];
if(array_key_exists("Sel",$_POST)){
	$Sel=$_POST['Sel'];
	$sql="SELECT Super FROM user WHERE LogINID='$Sel'";
	mysqli_query($db,"SET NAMES utf8mb4");
	$result=mysqli_query($db,$sql);
	$sup=mysqli_fetch_assoc($result);
	$sup=$sup['Super'];
	$sql="SELECT count(*) FROM user WHERE Super='$sup'";
	$result=mysqli_query($db,$sql);
	$num=mysqli_fetch_row($result);
	$num=$num[0];
	if($num==1){
		$sql1="DELETE FROM Superior WHERE name='$sup'";
		}
$sql="DELETE FROM user WHERE LogINID='$Sel'";
mysqli_query($db,"SET NAMES utf8mb4");
$res=mysqli_query($db,$sql);
if(isset($sql1)){
$result=mysqli_query($db,$sql1);
}
}
	

$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$ID=$row["ID"];
$sql = "select * from user where ID ='$ID'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

$picture=$row['Picture'];
$name=$row['Name'];
$unit=$A[$_SESSION['Dunit']];
if (empty($picture)) $picture = "../../img/profile.jpg";
else
$picture="../pic/".$picture;
$sql="SELECT Name, LogINID FROM user WHERE Unit='$unit'";
mysqli_query($db,"SET NAMES utf8mb4");
$result=mysqli_query($db,$sql);
$data=array();
while($row1=mysqli_fetch_assoc($result)){
	$data[]=array($row1['Name'],$row1['LogINID']);
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
		echo'<div class=" w3-text-blue div-table2">';
		echo '<table  class="w3-table w3-bordered table1">';
		foreach ($data as $value) {
			echo"<tr>";
			echo"<td><center><span class='a'><button type='submit' name='Sel'value='$value[1]' class='w3-button w3-btn 'style='width: 10%; border-radius: 12%; margin-top: 5%; margin-left: 33%; ' > <i class='fa fa-trash'></i> </button></center></td>";
			echo"<td><center><span  class='a'> $value[0] </span></center></td>";
			echo"<td><center><span  class='a'> $value[1] </span></center></td>";
			echo"</tr>";

		}
		echo"</table></div>";
		?>
		<div class="bt">
			<a href="delete.php" ><button type="button" class="w3-button w3-btn " style="border-radius: 10%;background: white ;" > الرجوع  </button></a>
		</div>
		<?php echo $foot;?>
		 <?php 
		 if(array_key_exists("Sel",$_POST))
		 {
		 	if($res==1){
          	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
                echo"تم الحذف بنجاح";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";

          }else
          {
          		echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #990000;'>";
                echo"لم يتم الحذف بنجاح ";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";

          }
      }?>

	</form>
	</body>
	</html>