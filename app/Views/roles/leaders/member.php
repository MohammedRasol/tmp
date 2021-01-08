<?php
include("../../php/session.php");
include("../../standard.php");
include 'sidebar.php';
$user=$_SESSION['login_id'];

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
else$picture="../pic/".$picture;
$sql="SELECT * FROM user WHERE LogINID='$_POST[show]'";
$result=mysqli_query($db,$sql);
$row = mysqli_fetch_assoc($result);
$munit=$row['Unit'];
$mname=$row['Name'];
$madd=$row['Address'];
$msuper=$row['Super'];
$mjoin=$row['JoinDate'];
$mbarth=$row['BarthDate'];
$mrelatev=$row['Relatev'];
$mphone=$row['Phone'];
$memail=$row['Email'];
$msuper=$row['Super'];
$mrel=$row['Relatev'];
$sql="SELECT * FROM superior WHERE name='$msuper'";
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$msname=$row['name'];
$msadd=$row['address'];
$msphone=$row['phone'];
$msjob=$row['job'];
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
	<link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<?php echo $sidebar;?>
	</div>
	<img src="../../img/c.png" class="imgg">
	<div class=" w3-text-blue div-table3">
		<table class="w3-table w3-bordered table1">
			<tr>
					
				<td rowspan="1"><center><span class=""> معلومات ولي الامر </span></center></td>
				<td></td>
				<td rowspan="1" ><center><span class=""> معلومات الفرد  </span></center></td> 
					
			</tr>
			<tr>
				<td><span class="a"><input class="c" type="" disabled value="<?php echo isset($msname)?$msname:NULL?>"></td>
				<td><span class="a"> :الاسم   </span></td>
				<td><span class="a"><input class="c" type=""disabled value="<?php echo isset($mname)?$mname:NULL?>"></td>
				<td><span class="a"> :الاسم   </span></td>
			</tr>
			<tr >
				<td><span class="a"><input class="c" type=""disabled value="<?php echo isset($mrel)?$mrel:NULL?>"></td>
				<td><span class="a"> :صلة القرابة</span></td>
				<td><span class="a"> 
					<input class="c" type=""disabled value="<?php echo isset($munit)?$munit:NULL?>" >
				</span></td>
				<td ><span  class="a  "> :الوحدة  </span></td>
			</tr>
			<tr >
				<td><span class="a"><input class="c" type="" disabled value="<?php echo isset($msadd)?$msadd:NULL?>"></td>
				<td><span class="a"> :العنوان</span></td>
				<td><span class="a">  <input class="c" type="" disabled value="<?php echo isset($madd)?$madd:NULL?>"></td>
				<td ><span class="a"> :العنوان</span></td>
			</tr>
			<tr>
				<td><span class="a"><input  class="c" type="" disabled value="<?php echo isset($msjob)?$msjob:NULL?>"></td>
				<td><span class="a"> :الوظيفة </span></td>
				<td><span class="a">  <input class="c" type="" disabled value="<?php echo isset($mjoin)?$mjoin:NULL?>"></td>
				<td ><span class="a"> :تاريخ الانضمام  </span></td>
			</tr>
			<tr >
				<td><span class="a"><input  class="c" type="" disabled value="<?php echo isset($msphone)?$msphone:NULL?>"></td>
				<td><span class="a"> :رقم الهاتف   </span></td>
				<td><span class="a">  <input  class="c" type="" disabled  value="<?php echo isset($mphone)?$mphone:NULL?>"></td>
				<td ><span class="a">  :رقم الهاتف </span></td>
			</tr>
			<tr>
				<td></td>
				<td></td>
				<td><span class="a">  <input class="c" type="" disabled value="<?php echo isset($memail)?$memail:NULL?>"></td>
				<td ><span class="a"> : البريد الالكتروني</span></td>
			</tr>
			<tr >
				<td></td>
				<td></td>
				<td><span class="a">  <input class="c" type="" disabled value="<?php echo isset($mbarth)?$mbarth:NULL?>"></td>
				<td > <span class="a">:تاريخ الميلاد </span></td>
			</tr>
		</table>
	</div>
	<div class="bt">
		<a href="members.php" ><button type="button" class="w3-button w3-btn " style=" border-radius: 10%; background: white ;" > الرجوع  </button></a>
	</div>
	<?php echo $foot;?>
</body>
</html>