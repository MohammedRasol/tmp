<?php
include("../../php/session.php");
include("../../standard.php");
include("sidebar.php");
$user=$_SESSION['login_id'];
if (array_key_exists('up',$_POST)) {
	$inid=$_POST['number'];
	$_SESSION['logid']=$inid;
	$sql="SELECT Name,LogINID,Unit,Phone FROM user WHERE LogINID='$inid'";
	$result=mysqli_query($db,$sql);
	$count=mysqli_num_rows($result);
	if($count===1){
	$row1=mysqli_fetch_assoc($result);
	$print=1;}
	else $error=true;
}
if (array_key_exists('new',$_POST)){
	$pass=createpass();
	$hashpass=sha1($pass);
	$sql="update user set Password= '$hashpass' where LogINID=$_SESSION[logid] ";
	$result=mysqli_query($db,$sql);
	$new=1;
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
if (empty($picture)) $picture = "../../img/profile.jpg";
else $picture="../pic/".$picture;
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
	<form  method="post" action="">
	<input class="w3-input w3-border w3-round-large" id="num" name="number" placeholder="رقم العضو" type="text" style="margin-top: 5%;width:10%;margin-left: 36%;">
	<div class="bt">
		<button class="w3-button w3-btn bt1" type="submit" name="up"  style="border-radius: 10%;background: white ;"> بحث</button><br>
	</div>
	<?php
	if(isset($print)){
		echo"<div class=' w3-text-blue t div-table1' style='margin-top:3%;' >";
		echo"<table   class='w3-table w3-bordered table1'>";
		echo"<tr>";
			echo"<td>";
				echo"<span class='a'></span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'> رقم الهاتف
							</span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'> الوحدة
							</span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'> رقم العضو
							</span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'> الاسم
							</span>";
			echo"</td>";
		echo"</tr>";
		echo"<tr>";
			echo"<td>";
				echo"<center><span class='a'>";
					echo '<button class="w3-button w3-btn bt1" type="submit" name="new"  style="margin-top: 0.5%;  border-radius: 10%;background: white ; margin-left: 39%;">كلمة سر جديدة</button>';
				echo"</span></center>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'>";
					echo"$row1[Phone]";
				echo"</span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'>";
					echo"$row1[Unit]";
				echo"</span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'>";
					echo"$row1[LogINID]";
				echo"</span>";
			echo"</td>";
			echo"<td>";
				echo"<span class='a'>";
					echo"$row1[Name]";
				echo"</span>";
			echo"</td>";
		echo"</tr>";
		echo "</table>";
		echo"</div>";
	}?>
	<?php echo $foot;?>
	<?php
	if(isset($error))
	{
		echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #990000;'>";
                echo"رقم العضو غير صحيح";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";
          echo"</div>";
	}
	if(isset($new))
	{
		echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #990000;'>";
                echo"كلمة السر الجديدة";
              echo"</p></center></b>";
              echo"<b><center><p style=' margin-top: 2%;color: #990000;'>";
                echo"$pass";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";
          echo"</div>";
	}
	?>
</form>
</body>
</html>