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
$name=$row['Name'];
if (empty($picture)) $picture = "../../img/profile.jpg";
else $picture="../pic/".$picture;
if(array_key_exists('del',$_POST)){
	$a=$_SESSION['reqid'];
	$sql="DELETE FROM request WHERE ID='$a'";
	$res=mysqli_query($db,$sql);
	if($res){
		unset($_SESSION['reqid']);
		header("location: requests.php");
}
}
if(array_key_exists('acp',$_POST))
	{
		//$_SESSION['data']=$data[0];
		header("location: accept.php");
	}
$req="select * from request where ID=$_POST[requestid]";
mysqli_query($db,"SET NAMES utf8mb4");
$res=mysqli_query($db,$req);

while($row1=mysqli_fetch_assoc($res)){
	
	$data[]=array($row1['ID'],$row1['name'],$row1['phone'],$row1['barthdate'],$row1['date'],$row1['address'],$row1['super'],$row1['reletev'],$row1['Sphone'],$row1['Saddress'],$row1['Sjob'],$row1['Notes'],$row['nationalID']);
}

if(isset($data[0][0]))
$_SESSION['reqid']=$data[0][0];
if(isset($data[0]))
	$_SESSION['data']=$data[0];

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
	<div class=" w3-text-blue" style="margin-right: 23%; margin-left: 9%;">
	<form method="post">
			<table  style=" border-radius: 10px; background-color:#e4e5e8;" class="w3-table w3-striped w3-bordered">
				<tr class="d">
					<td colspan=4 align=center>
						<center>
							<span style="font-size: 125%;"> معلومات الفرد  </span>
						</center>
					</td> 
				</tr>
				<tr class="d">
				<td>
					<span class="a">
						<input style="direction: rtl;" class="c" disabled name='nationalID' value="<?php echo $data[0][12];?>">
					</span>
				</td>
				<td>
					<span class="a">: الرقم الوطني </span>
				</td>
					<td>
					<span class="a">
							<input style="direction: rtl;" class="c" disabled name='ID' value="<?php echo $data[0][0];?>">
						</span>
					</td> 
					<td>
						<span class="a"> :طلب رقم   </span>
					</td>
				</tr>
				<tr class="d">
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][3];?>">
						</span>
					</td>
					<td>
						<span class="a"> :تاريخ الميلاد   </span>
					</td>
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][1];?>">
						</span>
						</td>
					<td>
						<span class="a"> :الاسم   </span>
					</td>
				</tr>
				<tr >
					<td>
						<span class="a">
						  <input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][2];?>">
						</span>
					</td>
					<td >
						<span class="a">  :رقم الهاتف </span>
					</td>
					<td>
						<span class="a" >
							<input style="direction: rtl;" disabled class="c" value="<?php echo $data[0][5];?>" >
						</span>
					</td>
                    <td>
                    	<span class="a"> :العنوان</span>
                    </td>
				</tr>
				<tr >
					<td colspan=3 >
						<span class="a">
							<input  style="direction: rtl; " class="c" disabled value="<?php echo $data[0][11]?>">
						</span>
					</td>
					<td >
						<span class="a"> الهوايات و المهارات</span>
					</td>
				</tr>
                <tr class="d">
					<td colspan=4 align=center>
						<center>
							<span style="font-size: 125%;"> معلومات ولي الامر </span>
						</center>
					</td> 
					
				</tr>
				<tr>
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][10]?>">
						</span>
					</td>
					<td><span class="a"> :الوظيفة </span></td>
                    <td>
                    	<span class="a">
                    		<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][6]?>">
                    	</span>
                    </td>
					<td>
						<span class="a"> :الاسم   </span>
					</td>
					
				</tr>
				<tr >
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][8]?>">
						</span>
					</td>
					<td>
						<span class="a"> :رقم الهاتف   </span>
					</td>
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][9]?>">
					 	</span>
					</td>
                    <td><span class="a"> :العنوان</span></td>
				</tr>
				<tr>
					<td></td>
					<td></td>
					<td>
						<span class="a">
							<input style="direction: rtl;" class="c" disabled value="<?php echo $data[0][7]?>">
						</span>
					</td>
					<td><span class="a"> :صلة القرابة</span></td>
				</tr>
				
			</table>
		</div>
		<div class="bt">
		<a href="requests.php" ><button type="button" class="w3-button w3-btn " style="border-radius: 10%;background: white ;" > الرجوع  </button></a>
		<button type="submit" class="w3-button w3-btn " name="acp" style="border-radius: 10%; background: white ;" > القبول </button> 
		<button type="submit" class="w3-button w3-btn " name="del" style="border-radius: 10%; background: white ;" > حذف  </button>
		</div>
		</form>
		<?php echo $foot;?>
</body>
</html>

