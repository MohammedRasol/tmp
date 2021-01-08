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
if (empty($picture)) $picture = "../../img/profile.jpg"; 
else
$picture="../pic/".$picture;
if(array_key_exists('show',$_POST)){
    $member=$_POST['show'];
$sql="SELECT * FROM user WHERE LogINID='$member'";
mysqli_query($db,"SET NAMES utf8mb4");
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$Mname=$row['Name'];
$Mlogin=$row['LogINID'];
$note=$row['Document'];
}
if(array_key_exists('add',$_POST)){
    $note=$_POST['mnote'];
    $member=$_POST['add'];
    $sql="UPDATE user SET Document='$note'";
    $res=mysqli_query($db,$sql);
    $sql="SELECT * FROM user WHERE LogINID='$member'";
mysqli_query($db,"SET NAMES utf8mb4");
$result=mysqli_query($db,$sql);
$row=mysqli_fetch_assoc($result);
$Mname=$row['Name'];
$Mlogin=$row['LogINID'];
$note=$row['Document'];

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
	<link rel="stylesheet" href="../../css/ameeen/table.css">
	<link rel="stylesheet" href="../../css/ameeen/profile.css">
    <link rel="icon" href="../../img/c.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<body>
	
	<div class="w3-sidebar w3-bar-block sidebar">
		<center><img src="<?php echo $picture ?>" alt="<?php echo $name ?>"class="w3-circle" style="width: 60%;height: 55%;" ></center>
		<h5 class="w3-bar-item w3-text-blue b"><?php echo $name ?>  </h5>
		<?php echo $sidebar; ?>
	</div>
	<img src="../../img/c.png" class="imgg">
	<form action="" method="post">
		<?php
			echo'<div class=" w3-text-blue" style="margin-right: 16%; margin-left: 20%; width:45%; margin-top:3%;">';
			echo '<table  style=" border-radius: 10px; background-image: linear-gradient(150deg,#d2d4d4,#f5f5f5,#ffffff);" class="w3-table w3-bordered">';
			echo"<tr>";
			echo"<td><center><span  class='a'> $Mname </span></center></td>";
			echo"<td><center><span  class='a'> $Mlogin</span></center></td>";
            echo"</tr>";
            echo "<tr><td colspan=2><textarea class='w3-input w3-border a' type='text' name='mnote' >";
            if(isset($note))
                echo "$note";
            echo "</textarea> ";
            echo "</td></tr>";
			echo"</table></div>";
		?>
    <div class="bt">
      <button type="submit" class="w3-button w3-btn " name="add" value="<?php echo $Mlogin; ?>" style=" border-radius: 10%; background: white ;" > حفظ </button>
		  <a href="note.php" ><button type="button" class="w3-button w3-btn " style=" border-radius: 10%; background: white ;" > الرجوع  </button></a>
    </div>
	</form>
	<?php echo $foot;?>
    <?php
    if(array_key_exists('add',$_POST))
    if($res==1){
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
    }
    ?>
</body>
</html>