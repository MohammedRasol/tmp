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
$unit=$row['Unit'];
$name=$row['Name'];
$add=$row['Address'];
$phone=$row['Phone'];
$email=$row['Email'];
$type=$row['Type'];
$picture=$row['Picture'];
if (empty($picture)) $picture = "../../img/profile.jpg"; 
$picture="../pic/".$picture;
if($_SERVER["REQUEST_METHOD"] == "POST") {
$reson=$_POST['reson'];
$job=$_POST['job'];
$day=date('Y-m-d');
$days=$_POST['days'];
$time = strtotime($_POST['start']);
$start=date('Y-m-d',$time);
$time = strtotime($_POST['end']);
$end=date('Y-m-d',$time);
$phone=$_POST['phone'];
$add=$_POST['add'];
$sql="INSERT INTO steprequst (name,unit,jobinunit,reason,numberofdays,startday,endday,date,phone,address,loginid) 
VALUES('$name','$unit','$job','$reson','$days','$start','$end','$day','$phone','$add','$user')";
$result = mysqli_query($db,$sql);
}
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
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
	<link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<a href="member.php" class="w3-bar-item w3-button w3-text-blue b w3-right-align"> <?php echo $count;?>: أيام الغياب  </a>
		<?php echo $sidebar;?>
	</div>
	
	<img src="../../img/c.png" class="imgg">
	<form method="post" action="">
		<div class=" w3-text-blue div-table3">
			<table class="w3-table w3-bordered table1">
				<tr class="d">

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php echo$unit;?>" disabled name="unit" >
						</span>
					</td>

					<td>
						<span class="a d"> :الوحدة    </span>
					</td>

					<td>
						<span class="a">
							<input class="c " type="" value="<?php echo $name;?>" name="name" disabled>
						</span>
					</td>

					<td>
						<span class="a"> :الاسم   </span>
					</td>

				</tr>

				<tr >

					<td>
						<span class="a" style="margin-right: 30%;">
						<?php echo"<select class='c  w w3-select' style='direction: rtl; width: 190%;' name='job' required>";
						if($type==='A'){
								echo"<option value='فرد'>فرد</option>";
		  						echo"<option value='عريف'  >عريف</option>";
								echo"<option value='مساعد عريف'  >مساعد عريف</option>";
								echo"<option value='عريف أول'  >عريف أول</option>";
								echo"<option value='مساعد عريف أول'  >مساعد عريف أول</option>";
							}
								else{
								echo '<option value="قائد">قائد</option>';
								echo'<option value="مساعد قائد">مساعد قائد</option>';
							}
							echo'</select>';
							 ?>
						</span>
					</td>

					<td>
						<span class="a d"> :الوظيفة للوحدة</span>
					</td>

					<td>
						<span class="a d"> 
						<input class="c d" type="" value="<?php echo date('Y-m-d');?>" name="date" disabled >
						</span>
					</td>

					<td><span  class="a  "> :تاريخ الطلب  </span></td>

				</tr>

				<tr >

					<td>
						
						
						<span class="a d" >
						<input class="c d" type="" value="" name="days"required>
						</span>
						
					</td>

					<td>
						<span class="a d"> :أيام التوقف بالأرقام</span>
					</td>

					<td>
						
						 
						 <span class="a d" >
						 <input class="c d" type="" value="" name="reson"required>
						</span>


					</td>

					<td >
						<span class="a"> :سبب التوقف</span>
					</td>

				</tr>

				<tr>

					<td>
						<span class="a d">
							<input class="c d" type="" value="" name="end"placeholder="year-month-day"required>
						</span>
					</td>

					<td>
						<span class="a d"> :تنتهي بتاريخ </span>
					</td>
					<td>
						<span class="a">
						  <input  class="c" type="" name="start" placeholder="year-month-day" value=""required>
						</span>
					</td>

					<td >
						<span class="a"> :تبدأ بتاريخ  </span>
					</td>

				</tr>

				<tr >

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php echo $phone;?>" name="phone" required>
						</span>
					</td>

					<td>
						<span class="a d"> :رقم الهاتف   </span>
					</td>
					<td>
						<span class="a" style="margin-right: 39%;">
							<select class="c w w3-select" style="direction: rtl; width: 260%;" name="add" required>
								<option value="" disabled selected>أختر العنوان</option>
		  						<option value="الزرقاء"  <?php  if ($add=="الزرقاء")  echo "selected"?> >الزرقاء</option>
								<option value="عمان"  <?php  if ($add=="عمان")  echo "selected"?> >عمان</option>
								<option value="أخرى"  <?php  if ($add=="أخرى")  echo "selected"?>>أخرى</option>
							</select> 
						</span>
					</td>
					<td ><span class="a"> :العنوان</span></td>
				</tr>
			</table>
		</div>
		<div class="bt">
			<button type="submit" class="w3-button w3-btn " name="save" style=" border-radius: 10%; background: white ;" > حفظ  </button>
			<button type="button" class="w3-button w3-btn " name="exit" style=" border-radius: 10%;  background: white ;" onclick=location='member.php'; > إلغاء  </button>
		</div>
		</form>
		<?php echo $foot;?>
		<?php
		if($result===true){
			echo"<div id='i' class='w3-modal' style='display:block;'>";
			echo"<div class='w3-modal-content' style='width:30%;'>";
			 echo"<div class='w3-container'>";
			  echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
			   echo"&times;";
			  echo"</span>";
		
			  echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
				echo"تم تقديم طلبك بنجاح <br/> سوف يقوم قائد وحدتك بتواصل معك لأتمام الطلب"."<br>";
			  echo"</p></center></b>";
			  echo"<center>
				<button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=location='member.php'; > اغلاق </button>
				</center>";
			  echo"</div>";
			echo"</div>";
		}
			?>
</body>
</html>