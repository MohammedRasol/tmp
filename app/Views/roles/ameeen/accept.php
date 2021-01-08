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

$picture=$row['Picture'];
$name=$row['Name'];
if (empty($picture))
 	$picture = "../../img/profile.jpg";
else 
	$picture="../pic/".$picture;
#print_r($_SESSION);
$data[]=$_SESSION['data'];
if($_SERVER["REQUEST_METHOD"] == "POST"){
	unset($error);
	$sname=empty($_POST['sname'])?NULL:$_POST['sname'];
	$srel=empty($_POST['srel'])?NULL:$_POST['srel'];
	if(isset($_POST['nunit']))
	if($_POST['nunit']!=='5'&&!isset($_POST['leader'])){
		if(!preg_match(Names, $_POST['sname'])or empty($_POST['sname']))
			$error=SNameE;
		if(!preg_match(Phones,$_POST['sphone'])or empty($_POST['sphone']))
			$error=SPhoneE;
		if(empty($_POST['sjob']))
			$error=SJopE;
		if($srel===NULL)
			$error=RelE;
		else{
			$sql="SELECT id FROM superior WHERE name ='$sname'";
			$sphone=$_POST['sphone'];
			$sadd=$_POST['sadd'];
			$sjob=$_POST['sjob'];
			$result = mysqli_query($db,$sql);
			if(mysqli_num_rows($result)===0){
				$sqls="INSERT INTO superior(name,phone,job,address) VALUES ('$sname','$sphone','$sjob','$sadd')";
				$result = mysqli_query($db,$sqls);
				}
			else{
				$sqls="UPDATE superior SET phone='$sphone',address='$sadd',job='$sjob' WHERE name='$sname'";
				$result = mysqli_query($db,$sqls);
			}

		}
	}
		if(!preg_match(Names, $_POST['nname'])){
			$error=NameE;
	}

		elseif (!preg_match(Phones,$_POST['nphone'])) 
			$error=PhoneE;	

			elseif(!preg_match(Emails, $_POST['nemail']))
				$error=EmailE;
			
			elseif(!joinchick($_POST['njoin'])){
				$error=JoinE;
				echo len($_POST['njoin']);
			}

			elseif(!brathchick($_POST['nbarth']))
				$error=BarthE;
			elseif(checkNID_users($_POST['nationalID'],$db))
				$error=same_national_id_for_another_user;
			else{
			$nname=$_POST['nname'];
			$nadd=$_POST['nadd'];
			$nphone=$_POST['nphone'];
			$njoin=$_POST['njoin'];
			$nbarth=$_POST['nbarth'];
			$nemail=$_POST['nemail'];
			$nationalID=$_POST['nationalID'];
			$pass=createpass();
			$hashpass=sha1($pass);
			$newlogin =generat($_POST['nunit'],$db);
			$nunit=$A[$_POST['nunit']];
			$type='A';
			if(isset($_POST['leader']))
			{
				$type='B';
				$sname=NULL;
				$srel=NULL;
			}
			if($_POST['nunit']==='5')
			{
				$type='C';
			}
			if($sname!==NULL)
			$sql="INSERT INTO user(LogINID ,Name ,Address ,Unit,Super ,Relatev ,JoinDate ,BarthDate ,Picture ,Document ,Type ,Password ,Phone ,Email ,Attendance,nationalID) VALUES('$newlogin' , '$nname' , '$nadd' , '$nunit' , '$sname' , '$srel' , '$njoin' , '$nbarth' , NULL , NULL , '$type' , '$hashpass' ,'$nphone','$nemail', 0,'$nationalID')";
		else
			$sql="INSERT INTO user(LogINID ,Name ,Address ,Unit,Super ,Relatev ,JoinDate ,BarthDate ,Picture ,Document ,Type ,Password ,Phone ,Email ,Attendance,nationalID) VALUES('$newlogin' , '$nname' , '$nadd' , '$nunit' , NULL , NULL , '$njoin' , '$nbarth' , NULL , NULL , '$type' , '$hashpass' ,'$nphone','$nemail', 0,'$nationalID)";
			//echo $sql;
			$result = mysqli_query($db,$sql);
			if($result){
				unset($_POST['nname']);
				unset($_POST['nadd']);
				unset($_POST['nphone']);
				unset($_POST['njoin']);
				unset($_POST['nbarth']);
				unset($_POST['nemail']);
				unset($_POST['nunit']);
				unset($_POST['sname']);
				unset($_POST['srel']);
				unset($_POST['sadd']);
				unset($_POST['sjob']);
				unset($_POST['sphone']);
			}
		}
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
	<form method="post" action="">
		<div class=" w3-text-blue div-table3">
			<table class="w3-table w3-bordered table1">
				<tr>
					
					<td rowspan="1" class="d">
						<center>
							<span class=""> معلومات ولي الامر </span>
						</center>
					</td>
					<td>
						
					</td>

					<td rowspan="1" >
						<center>
							<span class=""> معلومات الفرد  </span>
						</center>
					</td> 
					
				</tr>

				<tr class="d">	
					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($data[0][6]))echo $data[0][6];?>" name="sname" placeholder="الاسم الرباعي">
						</span>
					</td>

					<td>
						<span class="a d"> :الاسم   </span>
					</td>
					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($data[0][6])) echo $data[0][12];?>" name="nationalID" placeholder="الرقم الوطني">
						</span>
					</td>	
					<td>
						<span class="a"> : الرقم الوطني </span>
					</td>

				</tr>

				<tr >

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($data[0][7]))echo$data[0][7];?>" name="srel" placeholder="اب عم خال اخ">
						</span>
					</td>

					<td>
						<span class="a d"> :صلة القرابة</span>
					</td>
					<td>
						<span class="a">
							<input class="c " type="" value="<?php if(isset($data[0][1]))echo$data[0][1];?>" name="nname" placeholder="الاسم الرباعي">
						</span>
					</td>

					<td>
						<span class="a"> :الاسم   </span>
					</td>

				</tr>

				<tr >

					<td>
						
							<!--<input  class="c d" type="" value="<?php if(isset($_POST['sadd']))echo$_POST['sadd'];?>" name="sadd">-->
						<span class="a d" style="margin-right: 42%;">
								<select class="c d w3-select" style="direction: rtl; width: 272%; " name="sadd" required>
								<option value="" disabled selected>أختر العنوان</option>
			  					<option value="الزرقاء"  <?php  if (isset($data[0][9])&&$data[0][9]=="الزرقاء")  echo "selected"?> >الزرقاء</option>

								<option value="عمان"  <?php  if (isset($data[0][9])&&$data[0][9]=="عمان")  echo "selected"?> >عمان</option>

								<option value="عجلون"  <?php  if (isset($data[0][9])&&$data[0][9]=="عجلون")  echo "selected"?>>عجلون</option>

								<option value="اربد"  <?php if (isset($data[0][9])&&$data[0][9]=="اربد")  echo "selected"?>>اربد</option>

								<option value="جرش"  <?php  if (isset($data[0][9])&&$data[0][9]=="جرش")  echo "selected"?>>جرش</option>

								<option value="المفرق"  <?php  if (isset($data[0][9])&&$data[0][9]=="المفرق")  echo "selected"?>>المفرق</option>

								<option value="البلقاء"  <?php  if (isset($data[0][9])&&$data[0][9]=="البلقاء")  echo "selected"?>>البلقاء</option>

								<option value="مأدبا"  <?php  if (isset($data[0][9])&&$data[0][9]=="مأدبا")  echo "selected"?>>مأدبا</option>

								<option value="العقبة"  <?php  if (isset($data[0][9])&&$data[0][9]=="العقبة")  echo "selected"?>>العقبة</option>

								<option value="الكرك"  <?php  if (isset($data[0][9])&&$data[0][9]=="الكرك")  echo "selected"?>>الكرك</option>

								<option value="معان"  <?php  if (isset($data[0][9])&&$data[0][9]=="معان")  echo "selected"?>>معان</option>

								<option value="الطفيلة"  <?php  if (isset($data[0][9])&&$data[0][9]=="الطفيلة")  echo "selected"?>>الطفيلة</option>

							</select> 
						</span>
						
					</td>

					<td>
						<span class="a d"> :العنوان</span>
					</td>
					<td>
						<span class="a" style="margin-right: 39%;"> 
							<select class="c w3-select un" name="nunit" style="width: 252%;" required>
								<option value="" disabled selected>اختيار الوحدة </option>
								<option value="1">الأشبال</option>
							  	<option value="2">الكشاف</option>
							  	<option value="3">المتقدم</option>
							  	<option value="4">الجوالة</option>
							  	<option value="5">القادة</option>
							</select>
						</span>
					</td>

					<td><span  class="a  "> :الوحدة  </span></td>
				</tr>

				<tr>

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($data[0][10]))echo$data[0][10];?>" name="sjob" placeholder="المسمى الوظيفي">
						</span>
					</td>

					<td>
						<span class="a d"> :الوظيفة </span>
					</td>
					<td>
						
						  <!--<input  class="c " type="" name="nadd" value="<?php if(isset($_POST['nadd']))echo$_POST['nadd'];?>">-->
						 <span class="a " style="margin-right: 42%;">
								<select class="c w3-select" style="direction: rtl; width: 272%; " name="nadd" required>
									<option value="" disabled selected>أختر العنوان</option>
			  						<option value="الزرقاء"  <?php  if (isset($data[0][5])&&$data[0][5]=="الزرقاء")  echo "selected"?> >الزرقاء</option>

									<option value="عمان"  <?php  if (isset($data[0][5])&&$data[0][5]=="عمان")  echo "selected"?> >عمان</option>

									<option value="عجلون"  <?php if (isset($data[0][5])&&$data[0][5]=="عجلون")  echo "selected"?>>عجلون</option>
								<option value="اربد"  <?php  if (isset($data[0][5])&&$data[0][5]=="اربد")  echo "selected"?>>اربد</option>
								<option value="جرش"  <?php  if (isset($data[0][5])&&$data[0][5]=="جرش")  echo "selected"?>>جرش</option>
								<option value="المفرق"  <?php  if (isset($data[0][5])&&$data[0][5]=="المفرق")  echo "selected"?>>المفرق</option>
								<option value="البلقاء"  <?php  if (isset($data[0][5])&&$data[0][5]=="البلقاء")  echo "selected"?>>البلقاء</option>
								<option value="مأدبا"  <?php if (isset($data[0][5])&&$data[0][5]=="مأدبا")  echo "selected"?>>مأدبا</option>
								<option value="العقبة"  <?php  if (isset($data[0][5])&&$data[0][5]=="العقبة")  echo "selected"?>>العقبة</option>
								<option value="الكرك"  <?php  if (isset($data[0][5])&&$data[0][5]=="الكرك")  echo "selected"?>>الكرك</option>
								<option value="معان"  <?php  if (isset($data[0][5])&&$data[0][5]=="معان")  echo "selected"?>>معان</option>
								<option value="الطفيلة"  <?php  if (isset($data[0][5])&&$data[0][5]=="الطفيلة")  echo "selected"?>>الطفيلة</option>
								</select> 
						</span>


					</td>

					<td >
						<span class="a"> :العنوان</span>
					</td>
				</tr>

				<tr >

					<td>
						<span class="a d">
							<input class="c d" type="" value="<?php if(isset($data[0][8]))echo$data[0][8];?>" name="sphone" placeholder="**********07">
						</span>
					</td>

					<td>
						<span class="a d"> :رقم الهاتف   </span>
					</td>
					<td>
						<span class="a">
						  <input  class="c" type="" name="njoin" placeholder="year-month-day" value="<?php echo date("Y-m-d");?>">
						</span>
					</td>

					<td >
						<span class="a"> :تاريخ الانضمام  </span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<span class="a">
						  <input class="c" type="" name="nphone" value="<?php if(isset($data[0][2]))echo$data[0][2];?>" placeholder="********07">
						</span>
					</td>

					<td >
						<span class="a">  :رقم الهاتف </span>
					</td>
				</tr>
				<tr >
					<td>
						<span class="a" style="font-size: 150%;">
							<label >قائد</label>
							<input class="w3-check d" type="checkbox" name="leader" id="lead">
						</span>
					</td>
					<td></td>
					<td>
						<span class="a">
						  <input class="c" type="" name="nemail" value="<?php if(isset($_POST['nemail']))echo$_POST['nemail'];?>" placeholder="البريد الالكتروني">
						</span>
					</td>
					<td >
						<span class="a"> : البريد الالكتروني</span>
					</td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<span class="a"> 
							<input class="c" placeholder="year-month-day" type="" name="nbarth" value="<?php if(isset($data[0][3]))echo$data[0][3];?>">
						</span>
					</td>
					<td >
						<span class="a">:تاريخ الميلاد </span>
					</td>
			</table>
		</div>
		<input class="w3-button w3-btn bt1" type="submit" name="" value="اضافة" style=" background: white; border-radius: 10%; margin-top: 3%; margin-left: 38%;">
		<a href="requests.php"><button class="w3-button w3-btn bt1" type="button" name="" style="background: white; border-radius: 10%; margin-top: 3%;">
			الغاء </button></a>
	</form>
	<?php echo $foot;?>
</body>
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
          echo"</div>";}
          elseif($result==1){
          	$rid=$_SESSION['reqid'];
          	$sql="DELETE FROM request WHERE ID=$rid";
          	$res = mysqli_query($db,$sql);
          	unset($_SESSION['data']);
          	unset($_SESSION['reqid']);
          	echo"<div id='i' class='w3-modal' style='display:block;'>";
            echo"<div class='w3-modal-content' style='width:30%;'>";
             echo"<div class='w3-container'>";
              echo"<span onclick=document.getElementById('i').style.display='none'; style='color: #990000;' class='w3-button w3-display-topright w3-red'>";
               echo"&times;";
              echo"</span>";

              echo"<b><center><p style=' margin-top: 7%;color: #009900;'>";
                echo"تم الاضافة بنجاح"."<br>";
                echo"$newlogin"."=رقم العضو"."<br>";
                echo"$pass"."=كلمة السر"."<br>";
                echo"يرجى تغير كلمة السر *";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=location='requests.php'; > اغلاق </button>
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
                echo"لم تتم الاضافة هناك مشكلة في الاتصال ";
              echo"</p></center></b>";
              echo"<center>
                <button type='button'class='w3-button w3-btn w3-red' style='border-radius:10%; margin-top:1%; margin-bottom:5%;' class='w3-button'onclick=document.getElementById('i').style.display='none'; > اغلاق </button>
                </center>";
              echo"</div>";
            echo"</div>";

          }}?>
</body>
</html>
