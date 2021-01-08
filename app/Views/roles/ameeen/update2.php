<?php
include("../../php/session.php");
include("../../standard.php");
include("sidebar.php");
$user=$_SESSION['login_id'];
$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$ID=$row["ID"];
if(array_key_exists('Up1',$_POST)){
$sql="SELECT ID FROM user WHERE LogINID='$_POST[Up1]'";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$IDu=$row['ID'];
$_SESSION['IDu']=$IDu;
}
if(array_key_exists("Up2",$_POST)){
	$IDu=$_SESSION['IDu'];
	$sql="SELECT Type FROM user WHERE ID=$IDu";
	$result=mysqli_query($db,$sql);
	$row=mysqli_fetch_assoc($result);
	$type=$row['Type'];
	if($type==="A"){
		$flag=true;
		if(!preg_match(Names, $_POST['sname'])){
			$error=SNameE;
		}
		elseif(!preg_match(Phones,$_POST['sphone'])){
			$error=SPhoneE;
		}
		elseif(empty($_POST['sjob'])){
				$error=SJopE;
		}
		elseif(!preg_match(Rels,$_POST['rel'])){
			$error=RelE;
		}

	}	
	if(!preg_match(Names, $_POST['name'])){
		$error=NameE;
	}

	elseif (!preg_match(Phones,$_POST['phone'])) {
		$error=PhoneE;
		}	

	elseif(!preg_match(Emails, $_POST['email'])){
		$error=EmailE;
			}

	elseif(!joinchick($_POST['join'])){
		$error=JoinE;
	}

	elseif(!brathchick($_POST['barth'])){
		$error=BarthE;
	}

	else{
		$name=mysqli_real_escape_string($db,$_POST['name']);
		$unit=$A[$_POST['unit']]; 
		$sql="SELECT Unit,LogINID,Super FROM user WHERE ID='$IDu'";
		$result=mysqli_query($db,$sql);
		$row=mysqli_fetch_assoc($result);
		if($unit!==$row['Unit']){
			$f=1;
			$newlogin =generat(array_search($unit,$A),$db);
		}
		else{
		$newlogin=$row['LogINID'];
	}
	if(isset($flag)){
		$unit=$A[$_POST['unit']]; 
		$Super=$row['Super'];
		$add=$_POST['add'];
		$join=$_POST['join'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$barth=$_POST['barth'];
		$sname=$_POST['sname'];
		$sadd=$_POST['sadd'];
		$sphone=$_POST['sphone'];
		$sjob=$_POST['sjob'];
		$rel=$_POST['rel'];
		$sql="UPDATE user SET  Name = '$name' , Unit = '$unit' , Address = '$add' , JoinDate = '$join' , BarthDate = '$barth' , Email = '$email' ,Phone='$phone',LogINID='$newlogin', Super='$sname',Relatev='$rel' WHERE ID = '$IDu'";
		
			$sqls="UPDATE superior SET name='$sname',phone='$sphone',job='$sjob',address='$sadd' WHERE name='$Super'";
			$ress=mysqli_query($db,$sqls);
			$res=mysqli_query($db,$sql);
			
	}
		else{
			$add=$_POST['add'];
		$join=$_POST['join'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$barth=$_POST['barth'];
			$sql="UPDATE user SET  Name = '$name' , Unit = '$unit' , Address = '$add' , JoinDate = '$join' , BarthDate = '$barth' , Email = '$email' ,Phone='$phone',LogINID='$newlogin', Super=NULL,Relatev=NULL WHERE ID = '$IDu'";
		
			$res=mysqli_query($db,$sql);
		}
	
}
}

$sql = "select * from user where ID ='$ID'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);

$apicture=$row['Picture'];
$aname=$row['Name'];

if (empty($apicture)) $apicture = "../../img/profile.jpg";
else
$apicture="../pic/".$apicture;

if(isset($error)&&!empty($_POST)){
		$name=$_POST['name'];
		$unit=$A[$_POST['unit']];
		$add=$_POST['add'];
		$join=$_POST['join'];
		$phone=$_POST['phone'];
		$email=$_POST['email'];
		$barth=$_POST['barth'];
		$sname=$_POST['sname'];
		$sadd=$_POST['sadd'];
		$sphone=$_POST['sphone'];
		$sjob=$_POST['sjob'];
		$rel=$_POST['rel'];
}

if(!isset($error)){
	$IDu=$_SESSION['IDu'];
	$sql="SELECT * FROM user WHERE ID = $IDu";
	$result=mysqli_query($db,$sql);
	$row = mysqli_fetch_assoc($result);
	$picture=$row['Picture'];
	$unit=($row['Unit']);
	$name=$row['Name'];
	$add=$row['Address'];
	$super=$row['Super'];
	$join=$row['JoinDate'];
	$barth=$row['BarthDate'];
	$relatev=$row['Relatev'];
	$phone=$row['Phone'];
	$email=$row['Email'];
	$super=$row['Super'];
	$rel=$row['Relatev'];
$sql="SELECT * FROM superior WHERE name='$super'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$sname=$row['name'];
$sadd=$row['address'];
$sphone=$row['phone'];
$sjob=$row['job'];}

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
		<center><img src="<?php echo $apicture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $aname ?>  </h5>
		<?php echo $sidebar;?>
	</div>
	<img src="../../img/c.png" class="imgg">
	<form method="post" action="">
		<div class=" w3-text-blue div-table3">
			<table class="w3-table w3-bordered table1">
				<tr>
					
					<td rowspan="1"><center><span class=""> معلومات ولي الامر </span></center></td>
					<td></td>
					<td rowspan="1" ><center><span class=""> معلومات الفرد  </span></center></td> 
					
				</tr>
				<tr>
					<td><span class="a"><input class="c d" type="" value="<?php echo isset($sname)?$sname:NULL?>" name="sname"></td>
					<td><span class="a"> :الاسم   </span></td>
					<td><span class="a"><input class="c" type="" value="<?php echo isset($name)?$name:NULL?>" name="name"></td>
					<td><span class="a"> :الاسم   </span></td>
				</tr>
				<tr >
					<td><span class="a"><input class="c d" type="" value="<?php echo isset($rel)?$rel:NULL?>" name="rel"></td>
					<td><span class="a"> :صلة القرابة</span></td>
					<td><span class="a" style="margin-right: 50.5%;"> 
						<select class="c un" name="unit" style="width: 391%;">
							<option value="1" <?php if ($unit=="الأشبال")  echo "selected"?>>الأشبال</option>
							<option value="2" <?php  if ($unit=="الكشاف" ) echo "selected"  ?>>الكشاف</option>
							<option value="3" <?php  if ($unit=="المتقدم")  echo "selected"?>>المتقدم</option>
							<option value="4" <?php  if ($unit=="الجوالة")  echo "selected"?>>الجوالة</option>
							<option value="5" <?php  if ($unit=="القادة")  echo "selected"?>>القادة</option>
						</select>
					</td>
					<td ><span  class="a  "> :الوحدة  </span></td>
				</tr>
				<tr >
					<td>
						<span class="a" style="margin-right: 42%;">
						<!--<input class="c d" type="" value="<?php echo isset($sadd)?$sadd:NULL?>" name="sadd">-->
							<select class="c w3-select d" style="direction: rtl; width: 268%; " name="sadd" required>
								<option value="" disabled selected>أختر العنوان</option>
		  						<option value="الزرقاء"  <?php  if ($sadd=="الزرقاء")  echo "selected"?> >الزرقاء</option>
								<option value="عمان"  <?php  if ($sadd=="عمان")  echo "selected"?> >عمان</option>
								<option value="عجلون"  <?php  if ($sadd=="عجلون")  echo "selected"?>>عجلون</option>
								<option value="اربد"  <?php  if ($sadd=="اربد")  echo "selected"?>>اربد</option>
								<option value="جرش"  <?php  if ($sadd=="جرش")  echo "selected"?>>جرش</option>
								<option value="المفرق"  <?php  if ($sadd=="المفرق")  echo "selected"?>>المفرق</option>
								<option value="البلقاء"  <?php  if ($sadd=="البلقاء")  echo "selected"?>>البلقاء</option>
								<option value="مأدبا"  <?php  if ($sadd=="مأدبا")  echo "selected"?>>مأدبا</option>
								<option value="العقبة"  <?php  if ($sadd=="العقبة")  echo "selected"?>>العقبة</option>
								<option value="الكرك"  <?php  if ($sadd=="الكرك")  echo "selected"?>>الكرك</option>
								<option value="معان"  <?php  if ($sadd=="معان")  echo "selected"?>>معان</option>
								<option value="الطفيلة"  <?php  if ($sadd=="الطفيلة")  echo "selected"?>>الطفيلة</option>
							</select>
						</span>

					</td>
					<td><span class="a"> :العنوان</span></td>
					<td>
						<span class="a" style="margin-right: 42%;"><!--  <input class="c" type="" name="add" value="<?php echo isset($add)?$add:NULL?>">-->
							<select class="c w3-select" style="direction: rtl; width: 268%; " name="add" required>
								<option value="" disabled selected>أختر العنوان</option>
		  						<option value="الزرقاء"  <?php  if ($add=="الزرقاء")  echo "selected"?> >الزرقاء</option>
								<option value="عمان"  <?php  if ($add=="عمان")  echo "selected"?> >عمان</option>
								<option value="عجلون"  <?php  if ($add=="عجلون")  echo "selected"?>>عجلون</option>
								<option value="اربد"  <?php  if ($add=="اربد")  echo "selected"?>>اربد</option>
								<option value="جرش"  <?php  if ($add=="جرش")  echo "selected"?>>جرش</option>
								<option value="المفرق"  <?php  if ($add=="المفرق")  echo "selected"?>>المفرق</option>
								<option value="البلقاء"  <?php  if ($add=="البلقاء")  echo "selected"?>>البلقاء</option>
								<option value="مأدبا"  <?php  if ($add=="مأدبا")  echo "selected"?>>مأدبا</option>
								<option value="العقبة"  <?php  if ($add=="العقبة")  echo "selected"?>>العقبة</option>
								<option value="الكرك"  <?php  if ($add=="الكرك")  echo "selected"?>>الكرك</option>
								<option value="معان"  <?php  if ($add=="معان")  echo "selected"?>>معان</option>
								<option value="الطفيلة"  <?php  if ($add=="الطفيلة")  echo "selected"?>>الطفيلة</option>
							</select>
						</span>
					</td>
					<td ><span class="a"> :العنوان</span></td>
				</tr>
				<tr>
					<td><span class="a"><input  class="c d" type="" value="<?php echo isset($sjob)?$sjob:NULL?>" name="sjob"></td>
					<td><span class="a"> :الوظيفة </span></td>
					<td><span class="a">  <input class="c" type="" name="join" value="<?php echo isset($join)?$join:NULL?>"></td>
					<td ><span class="a"> :تاريخ الانضمام  </span></td>
				</tr>
				<tr >
					<td><span class="a"><input  class="c d" type="" value="<?php echo isset($sphone)?$sphone:NULL?>" name="sphone"></td>
					<td><span class="a"> :رقم الهاتف   </span></td>
					<td><span class="a">  <input  class="c" type="" name="phone" value="<?php echo isset($phone)?$phone:NULL?>"></td>
					<td ><span class="a">  :رقم الهاتف </span></td>
				</tr>
				<tr>
					<td><span class="a " style="font-size: 150%;">
							<label >قائد</label>
							<input class="w3-check d" type="checkbox" name="leader" id="lead">
						</span></td>
					<td></td>
					<td><span class="a">  <input class="c" type="" name="email" value="<?php echo isset($email)?$email:NULL?>"></td>
					<td ><span class="a"> : البريد الالكتروني</span></td>
				</tr>
				<tr >
					<td></td>
					<td></td>
					<td><span class="a">  <input class="c" type="" name="barth" value="<?php echo isset($barth)?$barth:NULL?>"></td>
					<td > <span class="a">:تاريخ الميلاد </span></td>
				</tr>
			</table>
		</div>
		<div class="bt">
			<button class="w3-button w3-btn " type="submit" name="Up2"  style=" border-radius: 10%;background: white ;"> حفظ </button>
			<a href="update.php"><button type="button" class="w3-button w3-btn" style="border-radius: 10%; background: white ;" > الغاء </button></a>
		</div>
	</form>
	<?php echo $foot;?>
	<?php
		if(array_key_exists("Up2",$_POST)){
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
      }elseif(isset($f)){if($f==1&&$res==1){
      	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
                echo"تم التعديل بنجاح"."<br>";
                echo"$newlogin"."=رقم العضو"."<br>";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";

      }}elseif($res==1){
      	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
                echo"تم التعديل بنجاح"."<br>";
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

      }
		}
	?>

	<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="add.js"></script>

</body>
</html>