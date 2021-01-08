<?php
class User extends Model
{
    private  $NID,  $barth, $name, $phone, $add, $unit, $hobbies,
        $rel, $sjob, $sname, $sphone, $sadd, $today;


    public function __construct()
    {

        parent::__construct();
        $this->today = date("Y-m-d");
        $a = func_get_args();
        $i = func_num_args();
        if (method_exists($this, $f = '__construct' . $i)) {
            call_user_func_array(array($this, $f), $a);
        }
    }
    function __construct1($data)
    {
        $tmp = "";
        foreach ($data as $index => $val) {
            $tmp = "$index";
            $this->$tmp = $val;
        }
    }

    public function login($myusername = "", $mypassword = "")
    {

        $db = $this->ConnectToDataBase();

        // if($loginid!=""){
        //     $sql_qy="SELECT Type FROM user WHERE LogINID=$loginid";
        //     $result=mysqli_query($db,$sql_qy);
        //     $row=mysqli_fetch_array($result);
        //     $page=$row['Type'];

        //     if($page==='C')
        //           header("location: ../../profiles/ameeen/");
        //         //if user type is B then this user profile is in page leader.php
        //         elseif($page==='B')
        //           header("location: ../../profiles/leaders/");
        //         //if user type is C then this user profile is in page ameeen.php
        //         elseif($page==='A') 
        //           header("location: ../../profiles/members/");   
        //         elseif($page==='D')
        //         $stop=true;
        //   }
        //   else
        //check if the login id that the user submit it is accesstble to the site standard 
        if (preg_match(Logins, $myusername)) {
            // username and password sent from form 
            $myusername = mysqli_real_escape_string($db, $myusername);
            $mypassword = mysqli_real_escape_string($db, $mypassword);
            //create a ? password using function 'sha1'
            //all the passwords stored in database must be ? using the same function
            $hashpass = sha1($mypassword);
            // search for the user information in the database acording to the login id and cheack the password for this user
            $sql = "SELECT Name,LogINID,Type FROM user WHERE LogINID = '$myusername' and Password = '$hashpass'";
            $result = mysqli_query($db, $sql);
            $row = mysqli_fetch_assoc($result);
            //stor the thpe of user to ues it leater 
            //stor the number of rows returned from the database      
            $count = mysqli_num_rows($result);
            // if result matched $myusername and $mypassword, $count must ? 1
            if ($count == 1) {
                $type = $row['Type'];
                //stor the user key information in the session 
                $_SESSION['login_user'] = $row['Name'];
                $_SESSION['login_id'] = $row['LogINID'];
                $_SESSION['Type'] = $type;
                //if user type is C then this user profile is in page ameeen.php
                if ($type === 'C') {
                    redirect("role.ameeen");
                }
                //if user type is B then this user profile is in page leader.php
                elseif ($type === 'B')
                redirect("role.leaders");
                //if user type is C then this user profile is in page ameeen.php
                elseif ($type === 'A')
                redirect("role.members");
                elseif ($type === 'D')
                    $stop = true;
            }
            //if $count is not 1 then ther is no user in the database have this login id or the password don't match this user
            else {
                Error('login_error',"يرجى التأكد من البيانات المدخلة ");
                redirect("login");

             
            }
        } 
        else {
            Error('login_error',"يرجى التأكد من البيانات المدخلة ");

            $this->view('login_regist/login');
        }
    }


    public function registration($post)
    {

        $db = $this->ConnectToDataBase();
 

        $sql = "SELECT name FROM request WHERE nationalID=   '$post[NID]'";
        $res = mysqli_query($db, $sql);
        if (mysqli_num_rows($res) > 0) {

            Error('reg_error', "لقد تم تقديم طلب بأستخدام الرقم الوطني المدخل مسبقاً");
            // die(print_r($_SESSION['error']));

            redirect("registration", $post, "form_inputs");
        } else {

            $sql = "INSERT INTO request (name,barthdate,address,phone,super,reletev,Sphone,Saddress,Sjob,Notes,nationalID)
			VALUES(
                 '$post[name]',
                 '$post[barth]',
                   '$post[add]',
                  '$post[phone]',
                '$post[sname]',
              ' $post[rel]',
                 '$post[sphone]',
              ' $post[sadd]',
              '$post[sjob] '  ,
                 '  $post[hobbies]',
                '$post[NID]'
                   )
                  ";

            // $res = mysqli_query($db, $sql);
            if (!$db -> query("INSERT INTO request (name,barthdate,address,phone,super,reletev,Sphone,Saddress,Sjob,Notes,nationalID)
			VALUES(
                 '$post[name]',
                 '$post[barth]',
                   '$post[add]',
                  '$post[phone]',
                '$post[sname]',
              ' $post[rel]',
                 '$post[sphone]',
              ' $post[sadd]',
              '$post[sjob] '  ,
                 '  $post[hobbies]',
                '$post[NID]'
                   )")) {
                echo("Error description: " . $db -> error);
              }

            if ($res) {
                if (isset($_SESSION['form_inputs']))
                    unset($_SESSION['form_inputs']);
                redirect("registration", 1, "res");
            } else
                Error('reg_error', "Error");
            redirect("registration", $post, "form_inputs");
        }
    }
}
