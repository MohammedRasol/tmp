<?php
include("../../php/session.php");
include("../../standard.php");
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<a href="member.php" class="w3-bar-item w3-button w3-text-blue b w3-right-align"> المعلومات الشخصية  </a>
		<a href="stop.php" class="w3-bar-item w3-button w3-text-blue b w3-right-align"> طلب التوقف </a>  
		<a href="../../php/logout.php" class="w3-bar-item w3-button w3-text-blue b w3-right-align">الخروج </a>
	</div>
	<img src="../../img/c.png" class="imgg">

	<form method="post" action="">
		<div class=" w3-text-blue" style="margin-right: 16%; margin-left: 16%;">
			<table  style=" border-radius: 10px; background-color:#e4e5e8;" class="w3-table w3-striped w3-bordered">
				<tr class="d">
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" type="" value="" name="unit">
						</span>
					</td>
					<td align=center><center><span class="e"> الوحدة </span></center></td>	
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" type="" value="" name="name"  placeholder="الأسم الرباعي">
						</span>
					</td>
					<td align=center><center><span class="e"> الاسم </span></center></td>	
				</tr>
				<tr class="d">
					<td colspan="3"><span class="a"><input style="direction: rtl;" class="c" type="" value="" name="" placeholder=""></td>
					<td><span class="a"> المهمة في الحدة   </span></td>
				</tr>
				<tr >
					<td colspan="3"><span class="a">  <input style="direction: rtl;" class="c" type="" name="" value="" placeholder ></td>
					<td ><span class="a">  سبب التوقف</span></td>
				</tr>
				<tr >
					
					<td colspan=3 ><span class="a"><input size=65 style="direction: rtl; " class="c" type="" value="" name="hobbies"placeholder="الرسم,كرة القدم,السباحة,....."></td>
					<td ><span class="a"> الهوايات و المهارات</span></td>
				</tr>
                <tr class="d">
					
					
					
					<td colspan=4 align=center><center><span class="e"> معلومات ولي الامر </span></center></td> 
					
				</tr>
				<tr>
					<td><span class="a"><input style="direction: rtl;" class="c" type="" value="" name="sjob"placeholder="المسمى الوظيفي"></td>
					<td><span class="a"> :الوظيفة </span></td>
                    <td><span class="a"><input style="direction: rtl;" class="c" type="" value="" name="sname"placeholder="الأسم الرباعي"></td>
					<td><span class="a"> :الاسم   </span></td>
					
				</tr>
				<tr >
					<td><span class="a"><input style="direction: rtl;" class="c" type="" value="" name="sphone" placeholder="********07"></td>
					<td><span class="a"> :رقم الهاتف   </span></td>
					<td><span class="a" style="margin-right: 46%;"><select class="c" style="direction: rtl; width: 248%;" name="sadd" required>
						<option value="" disabled selected>أختر العنوان</option>
  						  <option value="الزرقاء" >الزرقاء</option>
						  <option value="عمان" >عمان</option>
						  <option value="أخرى" >أخرى</option>
						</select> </span></td>
                    <td><span class="a"> :العنوان</span></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td><span class="a"><input style="direction: rtl;" class="c" type="" value="" name="rel"placeholder="أب عم خال أخ"></td>
					<td><span class="a"> :صلة القرابة</span></td>
				</tr>
				
			</table>
		</div>
		<input class="w3-button w3-btn bt1" type="submit" name="" value="حفظ " style="background-color: gray; border-radius: 10%; margin-top: 3%; margin-left: 40%;">
		<a href="login.php">
			<button type="button" class="w3-button w3-btn bt2" style="margin-top: 3%;border-radius: 10%; background: gray ;" > الغاء </button>
		</a>

	</form>


	<footer class="w3-container w3-text-blue "  style=" background-image: linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff); opacity: .9; margin-top: 7%;padding: 1%; margin-right: 15%;">
        <center><span style=""> Copyright &copy; 2018 - Alquds Scouts Group</span></center>
	</footer>
</body>
</html>