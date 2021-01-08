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
$name=$row['Name'];
$picture=$row['Picture'];
if (empty($picture)) $picture = "../../img/profile.jpg"; 
$picture="../pic/".$picture;
if(!array_key_exists('acp', $_POST)){
$id=$_POST['id'];
$sql="SELECT * FROM steprequst WHERE ID='$id'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$Mname=$row['name'];
$Munit=$row['unit'];
$job=$row['jobinunit'];
$reson=$row['reason'];
$days=$row['numberofdays'];
$start=$row['startday'];
$end=$row['endday'];
$date=$row['date'];
$phone=$row['phone'];
$add=$row['address'];
$login=$row['loginid'];
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
	<form method="post" action="">
		<div class=" w3-text-blue div-table3">
			<table class="w3-table w3-bordered table1">
				<tr class="d">

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($Munit)) echo $Munit;?>" disabled  >
						</span>
					</td>

					<td>
						<span class="a d"> :الوحدة    </span>
					</td>

					<td>
						<span class="a">
							<input class="c " type="" value="<?php if(isset($Mname)) echo $Mname;?>"  disabled>
						</span>
					</td>

					<td>
						<span class="a"> :الاسم   </span>
					</td>

				</tr>

				<tr >

					<td>
                    <span class="a">
							<input class="c " type="" value="<?php if(isset($job)) echo $job;?>"  disabled>
						</span>
					</td>

					<td>
						<span class="a d"> :الوظيفة للوحدة</span>
					</td>

					<td>
						<span class="a d"> 
						<input class="c d" type="" value="<?php if(isset($date)) echo $date;?>"  disabled >
						</span>
					</td>

					<td><span  class="a  "> :تاريخ الطلب  </span></td>

				</tr>

				<tr >

					<td>
						
						
						<span class="a d" >
						<input class="c d" type="" value="<?php if(isset($days)) echo $days;?>"  disabled>
						</span>
						
					</td>

					<td>
						<span class="a d"> :أيام التوقف بالأرقام</span>
					</td>

					<td>
						
						 
						 <span class="a d" >
						 <input class="c d" type="" value="<?php if(isset($reson)) echo $reson;?>" disabled>
						</span>


					</td>

					<td >
						<span class="a"> :سبب التوقف</span>
					</td>

				</tr>

				<tr>

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($end)) echo $end;?>" disabled>
						</span>
					</td>

					<td>
						<span class="a d"> :تنتهي بتاريخ </span>
					</td>
					<td>
						<span class="a">
						  <input  class="c" type="" value="<?php if(isset($start)) echo $start;?>"disabled>
						</span>
					</td>

					<td >
						<span class="a"> :تبدأ بتاريخ  </span>
					</td>

				</tr>

				<tr >

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($phone)) echo $phone;?>" name="phone" disabled>
						</span>
					</td>

					<td>
						<span class="a d"> :رقم الهاتف   </span>
					</td>
					<td>
                    <span class="a">
							<input class="c " type="" value="<?php if(isset($add)) echo $add;?>"  >
						</span>
					</td>
					<td ><span class="a"> :العنوان</span></td>
				</tr>
			</table>
			<div class="bt" style="margin-left: 41%;">
				<button type="button" class="w3-button w3-btn " name="exit" style="border-radius: 10%;background: white ;" onclick=location='step.php'; > رجوع  </button>
				<button type="submit" class="w3-button w3-btn " name="acp" value="<?php if(isset($login)) echo $login; ?>" style="border-radius: 10%; background: white ;" onclick=location='step.php'; > موافقة  </button>
			</div>
		</div>
	</form>
		<?php echo $foot;?>
		<?php
		if(array_key_exists('acp', $_POST))
		{
			$login=$_POST['acp'];
			$sql="UPDATE user SET Type='D' WHERE LogINID='$login'";
			$result = mysqli_query($db,$sql);
          	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
                echo"تم الايقاف"."<br>";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=location='step.php'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";
		}
		?>
</body>
</html>