<?php
class Login extends Controller
{

    public function index($name = "")
    {

        // $user = $this->model("User");

        // $conn = $user->ConnectToDataBase();
        // $res = $conn->query("select * from user ");
        // $user->DisconnectDataBase();
        $this->view('login_regist/login');
    }
    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if ($_POST['number']) {

                $user = $this->model("User");
                $conn = $user->ConnectToDataBase();
                // username and password sent from form 
                $myusername = mysqli_real_escape_string($conn, $_POST['number']);
                $mypassword = mysqli_real_escape_string($conn, $_POST['password']);
                $user->login($myusername, $mypassword);
            }
        }
        else
        $this->view('login_regist/login/index');

    }

    public function registration(){
        $this->view('login_regist/registration');

    }


    public function signup()
    {
 
      if ($_SERVER["REQUEST_METHOD"] == "POST") {
    {
     //  die(print_r($_POST));
		$NID=$_POST['NID'];
		$name=$_POST['name'];
		$phone=$_POST['phone'];
		$barth=$_POST['barth'];
		$hobbies=$_POST['hobbies'];
		$add=$_POST['add'];
		$sname=$_POST['sname'];
		$rel=$_POST['rel'];
		$sadd=$_POST['sadd'];
		$sphone=$_POST['sphone'];
		$sjob=$_POST['sjob'];
		if(!preg_match(NatunalID,$NID))
			$error=NatunalIDE;
		elseif(!preg_match(Names,$name))
			$error=NameE;
		elseif(!preg_match(Phones,$phone))
			$error=PhoneE;
		elseif(!brathchick($barth))
			$error=BarthE;
		elseif(!preg_match(Names,$sname))
			$erroe=SNameE;
		elseif(!preg_match(Rels,$rel))
			$error=RelE;
		elseif(!preg_match(Phones,$sphone))
			$error=SPhoneE;
		elseif(empty($sjob))
		$error="الرجاء أدخال وظيفة ولي الأمر";
		else{
			if(isset($_SESSION['form_inputs']))
			unset($_SESSION['form_inputs']);
            $user = $this->model("User");      
            $user->registration($_POST);
		}
		if(isset($error)){
			Error('reg_error',$error);
			$_SESSION['form_inputs']=$_POST;
			redirect("registration",$_POST,"form_inputs");
		}
	}
    }
}
}
?>