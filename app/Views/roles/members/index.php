<?php
error_reporting(0);
include("../../php/session.php");
include("../../standard.php");
include("sidebar.php");
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
$unit=$row['Unit'];
$join=$row['JoinDate'];
$barth=$row['BarthDate'];
$super=$row['Super'];
		if(array_key_exists("up",$_POST)){
	if(!preg_match(Names, $_POST['name']))
		$error=NameE;

	elseif (!preg_match(Phones,$_POST['phone'])) {
		$error=PhoneE;
		}	

	elseif(!preg_match(Emails, $_POST['email'])){
		$error=EmailE;
	}
	elseif(!preg_match(Names, $_POST['sname']))
		$error=SNameE;
	elseif(!preg_match(Phones,$_POST['sphone']))
		$error=SPhoneE;
	else
	{
				if(!empty($_FILES["file"]["name"])){
		$targetDir = "../pic/";
$targetFilePath=$_FILES["file"]["name"];
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
//$name=$_POST['name'];
$fileName = $ID.".".$fileType;
$targetFilePath = $targetDir . $fileName;
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        if(move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database
            $sql="UPDATE user set Picture='$fileName' WHERE ID='$ID'";
            //echo $sql;
            $insert=mysqli_query($db,$sql);
            if($insert){
                $error = "تم تعديل الصورة بنجاح";
            }else{

                $error = "لم يتم التحميل بنجاح الرجاء إعادة المجاولة";
            } 
        }
        else{
            $error = "لم يتم التحميل بنجاح الرجاء إعادة المجاولة";
        }
    }
    else{
        $error = '<br/>الأنواع من الصور مسموح بها jpg, jpeg & png فقط هذا';
    }
}
		$sql="UPDATE user SET  Name = '$_POST[name]' , Unit = '$unit' , Address = '$_POST[add]' , JoinDate = '$join' , BarthDate = '$barth' , Email = '$_POST[email]' ,Phone='$_POST[phone]',LogINID='$user', Super='$_POST[sname]',Relatev='$_POST[rel]' WHERE ID = '$ID'";
		$sqls="UPDATE superior SET name='$_POST[sname]',phone='$_POST[sphone]',job='$_POST[sjob]',address='$_POST[sadd]' WHERE name='$super'";
		$res1=mysqli_query($db,$sqls);
		$res2=mysqli_query($db,$sql);
	}
}
$sql="select ID from user where LogINID=$user";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$ID=$row["ID"];
	if(array_key_exists("del",$_POST)){
	$sql="UPDATE user SET Picture=NULL WHERE ID='$ID'";
	$result=mysqli_query($db,$sql);
}
$sql = "select * from user where ID ='$ID'";
$result = mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);


$name=$row['Name'];
$add=$row['Address'];
$relatev=$row['Relatev'];
$phone=$row['Phone'];
$email=$row['Email'];
$super=$row['Super'];
$rel=$row['Relatev'];
$picture=$row['Picture'];
$sql="SELECT * FROM superior WHERE name='$super'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$sname=$row['name'];
$sadd=$row['address'];
$sphone=$row['phone'];
$sjob=$row['job'];
if (empty($picture)) $picture = "../../img/profile.jpg"; 
$picture="../pic/".$picture;

$sql="SELECT * FROM `attendance` WHERE loginid='$user'";
$result=mysqli_query($db,$sql);
$count=mysqli_num_rows($result);


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
	<form action="" method="POST" enctype="multipart/form-data">
		<div class=" w3-text-blue div-table3">
			<table class="w3-table w3-bordered table1">
			
						
					<td rowspan="1"><center><span class=""> معلومات ولي الامر </span></center></td>
					<td></td>
					<td rowspan="1" ><center><span class=""> معلومات الفرد  </span></center></td> 
						
				</tr>
				<tr>
					<td><span class="a"><input class="c w" type="" disabled name="sname" value="<?php echo isset($sname)?$sname:NULL?>"></td>
					<td><span class="a"> :الاسم   </span></td>
					<td><span class="a"><input class="c w" type=""disabled name="name" value="<?php echo isset($name)?$name:NULL?>"></td>
					<td><span class="a"> :الاسم   </span></td>
				</tr>
				<tr >
					<td><span class="a"><input class="c w" type=""disabled name="rel" value="<?php echo isset($rel)?$rel:NULL?>"></td>
					<td><span class="a"> :صلة القرابة</span></td>
					<td><span class="a"> 
						<input class="c" type=""disabled name="unit" value="<?php echo isset($unit)?$unit:NULL?>" >
					</span></td>
					<td ><span  class="a  "> :الوحدة  </span></td>
				</tr>
				<tr >
					<td>
						<span class="a" style="margin-right: 42%;">
							<select class="c w w3-select" style="direction: rtl; width: 264%;" name="sadd" required>
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
						<span class="a" style="margin-right: 39%;">
							<select class="c w w3-select" style="direction: rtl; width: 260%;" name="add" required>
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
					<td><span class="a"><input  class="c w" type="" disabled name="sjob" value="<?php echo isset($sjob)?$sjob:NULL?>"></td>
					<td><span class="a"> :الوظيفة </span></td>
					<td><span class="a">  <input class="c" type="" disabled name="join" value="<?php echo isset($join)?$join:NULL?>"></td>
					<td ><span class="a"> :تاريخ الانضمام  </span></td>
				</tr>
				<tr >
					<td><span class="a"><input  class="c w" type="" disabled name="sphone" value="<?php echo isset($sphone)?$sphone:NULL?>"></td>
					<td><span class="a"> :رقم الهاتف   </span></td>
					<td><span class="a">  <input  class="c w" type="" disabled name="phone"  value="<?php echo isset($phone)?$phone:NULL?>"></td>
					<td ><span class="a">  :رقم الهاتف </span></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><span class="a">  <input class="c w" type="" disabled name="email" value="<?php echo isset($email)?$email:NULL?>"></td>
					<td ><span class="a"> : البريد الالكتروني</span></td>
				</tr>
				<tr >
					<td></td>
					<td></td>
					<td><span class="a">  <input class="c" type="" disabled name="barth" value="<?php echo isset($barth)?$barth:NULL?>"></td>
					<td > <span class="a">:تاريخ الميلاد </span></td>
				</tr>
				<tr class="d" style="display: none">
				<td><center><button type="submit" class="w3-button w3-btn " name="del" style="border-radius: 10%;  background: white ;" > حذف الصورة الشصية  </button></center></td>
					<td></td>
					<td>
							<center><input style="display: none;" type="file" style="max-width: 2%;" name="file" id="file-1" class="inputfile inputfile-1" data-multiple-caption="{count} files selected"  multiple />
					<label for="file-1"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="17" viewBox="0 0 20 17"><path d="M10 0l-5.2 4.9h3.3v5.1h3.8v-5.1h3.3l-5.2-4.9zm9.3 11.5l-3.2-2.1h-2l3.4 2.6h-3.5c-.1 0-.2.1-.2.1l-.8 2.3h-6l-.8-2.2c-.1-.1-.1-.2-.2-.2h-3.6l3.4-2.6h-2l-3.2 2.1c-.4.3-.7 1-.6 1.5l.6 3.1c.1.5.7.9 1.2.9h16.3c.6 0 1.1-.4 1.3-.9l.6-3.1c.1-.5-.2-1.2-.7-1.5z"/></svg> <span>&hellip; تعديل الصورة الشخصية</span></label>
				</center>
					</td>
					<td >
						
					</td>
				</tr>
				
			</table>
		</div>
		<div class="bt">
			<button type="button" class="w3-button w3-btn edit" style="border-radius: 10%; background: white ;" > تعديل  </button>
			<a href="editpass.php"><button type="button" class="w3-button w3-btn edit1" style="border-radius: 10%; background: white ;" > تعديل كلمة السر  </button></a>
			<button class="w3-button w3-btn bt1" type="submit" name="up"  style=" display: none; border-radius: 10%;background: white ; "> حفظ </button>
			<button type="button" class="w3-button w3-btn bt2" style="border-radius: 10%;  display: none;background: white ;" > الغاء </button>
		</div>
	</form>
	<?php echo $foot;?>
	<?php
		if(array_key_exists("up",$_POST)){
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
      }elseif($res1==1 && $res2==1){
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

      }}?>
	<script type="text/javascript" src="../../js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="j.js"></script>
	<script src="custom-file-input.js"></script>
</body>
</html>