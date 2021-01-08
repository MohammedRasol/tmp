<?php
include("../../php/session.php");
include("../../standard.php");
include 'sidebar.php';
$user=$_SESSION['login_id'];
$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$ID=$row["ID"];
#echo $ID;
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$query=mysqli_query($db,"SELECT Password FROM user WHERE ID =$ID");
	$pass=mysqli_fetch_assoc($query);
	$pass=$pass['Password'];
	$chpass=sha1($_POST['pas1']);
	if($pass===$chpass){
		if(!empty($_POST['npas'])){
			if($_POST['npas']===$_POST['rnpas']){
			$newpass=sha1($_POST['npas']);
			$res=mysqli_query($db,"UPDATE user SET Password='$newpass'");
		}
		else
			$error="يجب أن تتطابق كلمتي السر المدخلتين";
	}
		else
			$error="يجب أدخال كلمة سر جديدة من 6 خانات لا تحتوي على فراغ";
	}
		else
			$error="كلمة السر غير صحيحة";
}
 $sql = "select * from user where ID ='$ID'";
      $result = mysqli_query($db,$sql);
     // echo $result;

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
		<form action="" method="post"	>
			<div class=" w3-text-blue div-table2">
				<table class="w3-table w3-bordered table1">
					<tr class="d">
						<td></td>
						<td></td>
						<td>
						<span class="a"><input class="c" type="password" name="pas1"> 
						</span>
						</td>
						<td>
							<center><span class="a">:كلمة السر الحالية   </span></center>
						</td>
					</tr>
					<tr class="d">
						<td></td>
						<td></td>
						<td>
						<span class="a"><input class="c" type="password" name="npas"> 
						</span>
						</td>
						<td>
							<center><span class="a">:كلمة السر الجديدة  </span></center>
						</td>
					</tr>
					<tr class="d">
						<td></td>
						<td></td>
						<td>
						<span class="a"><input class="c" type="password" name="rnpas"> 
						</span>
						</td>
						<td>
							<center><span class="a">:تاكيد كلمة السر   </span></center>
						</td>
					</tr>

				</table>
			</div>
			<div class="bt">
				<button class="w3-button w3-btn" type="submit" name="x"  style=" border-radius: 10%;background: white ;"> حفظ </button>
				<a href="leader.php"><button type="button" class="w3-button w3-btn " style="border-radius: 10%; background: white ;" > الغاء </button></a>
			</div>
			<?php echo $foot;?>
	</form>
	<?php
		if($_SERVER["REQUEST_METHOD"] == "POST"){
				if(isset($error)){
				 echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #990000;'>";
                echo"$error";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";
          echo"</div>";
      }if(isset($res))
      	{if($res==1){
      	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
                echo"تم تعديل كلمة السر بنجاح"."<br>";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";
      }else{
      	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #990000;'>";
                echo"لم تتم الاضافة هناك مشكلة في الاتصال ";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";

      }}
		}?>
	<script type="text/javascript" src="../../jquery-3.3.1.min.js"></script>
</body>
</html>