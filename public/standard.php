<?php
//standard define
define('Names','/^[\x{0600}-\x{06FF}]{2,10}[[:space:]][\x{0600}-\x{06FF}]{2,10}[[:space:]][\x{0600}-\x{06FF}]{2,10}[[:space:]][\x{0600}-\x{06FF}]{2,10}$/u');
define('Emails',"/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/");
define('Logins','/^1[1-5][0-9]{3}$/');
define("Phones",'/^07[7-9][0-9]{7}$/');
define('Rels','/^([\x{0600}-\x{06FF}]){2,10}([[:space:]][\x{0600}-\x{06FF}]{2,10})?/u');
define("NatunalID",'/^[0-9]{10}$/');
//Errors define 
define('NameE',"يجب أدخال الأسم الرباعي للعضو");
define('PhoneE',"يجب أدخال رقم هاتف مكون من عشر خانات للعضو");
define('LoginE',"رقم العضو أو كلمة السر غير صحيحة");
define('LoginidE',"رقم العضو لا يطابق شكل رقم العضو المكون من خمس خانات");
define('SNameE',"يجب أدخال الأسم الرباعي لولي الأمر");
define('SPhoneE',"يجب أدخال رقم هاتف مكون من عشر خانات لولي الأمر");
define('SJopE',"يجب ادخال وظيفة ولي الأمر");
define('RelE',"يجب ادخال صلة القرابة");
define('BarthE',"<br/>'2018-12-30'تاريخ الميلاد غير صحيح يجب أن يكون بهذا الشكل");
define('JoinE',"<br/>'2018-12-30'تاريخ الانضمام غير صحيح يجب أن يكون بهذا الشكل");
define('EmailE',"البريد الألكتروني غير صحيح");
define("NatunalIDE","الرقم الوطني المدخل غير صالح");
define("same_national_id_for_another_user","الرقم الوطني المدخل مستخدم من قبل عضو أخر");
//LogINID generat algorithm
function generat($unit,$db){
	$unit=$unit*1000+10000;
	//$db=mysqli_connect("localhost","root","","alqudsescoutgroup");
	$r1=mysqli_query($db,"SELECT LogINID FROM user WHERE LogINID>=$unit AND LogINID<($unit+1000) ORDER BY LogINID");
	while($t=mysqli_fetch_row($r1)){
	 $s[]=(int)$t[0];
	}
	if(!isset($s))
		return $unit;
	else{
		$max=$s[count($s)-1];
		if($max-$unit-1==count($s))
			return $max+1;
		else{
			$min=$s[0];
			if($min!==$unit)
				return $min-1;
			else
				$e=$min;
				while(true){
					$e++;
					if(!array_search($e, $s)){
						return $e;
						break;
					}
				}
		}
	}
}

//chick the join date
function joinchick($d){
	$start=strtotime('1-1-1996');
	$d=strtotime($d);
	$today=date("d-m-Y");
	$today=strtotime($today);
	if($d>$today||$d<$start||$d===false)
		return false;
	else 
		return true;
}

//chick the drath date
function brathchick($d){
	$d=strtotime($d);
	$today=date("d-m-Y");
	$today=strtotime($today);
	$defday=strtotime("1-1-1970");
	if($d>$today||$d===$defday||$d===false)
		return false;
	else 
		return true;
}

//create a random pass word
function createpass(){
$s="";
for ($i=0;$i<7;$i++)
$s.=rand(0,9);
return $s;
}

function checkNID_users($NID,$db){
$sql="SELECT Name FROM user WHERE nationalID='$NID'";
$result = mysqli_query($db,$sql);
return mysqli_num_rows($result)!=0;
}
function checkNID_reqester($NID,$db){
$sql="SELECT name FROM requst WHERE nationalID='$NID'";
$result = mysqli_query($db,$sql);
return mysqli_num_rows($result)!=0;
}
// A is an array that have the unit names 
$A[1]="الأشبال";
$A[2]="الكشاف";
$A[3]="المتقدم";
$A[4]="الجوالة";
$A[5]="القادة";
// types is an array that have the types map between database and folders
$Types['C']="ameeen";
$Types['B']="leaders";
$Types['A']="members";
$Types['D']="stoped";
?>