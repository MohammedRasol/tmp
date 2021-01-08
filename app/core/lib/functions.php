<?php
session_start();

function Error($index="", $data="")
{
    $_SESSION[$index] = $data;
}

function get_error($index)
{

    if (isset($_SESSION[$index])) {
        $tmp = $_SESSION[$index];
        unset($_SESSION[$index]);
        return $tmp;
    }
}
////////////////// Navigate To View with Data(optional)/////
function redirect($view, $data = "", $DataName = "")
{

    /*
View param => if you want to navigate to root dir (Views) Just pass view file name like => $view="login"
if you want to navigate to sub dir like (views/test/...) Pass sub File name . views file name like => $view="test.login"
*/
    $path = explode(".", $view);
    if (count($path) > 1)
        $view = "../".$path[0]."/".$path[1];
// die($view);

    if ($data != "") {

        $_SESSION[$DataName] = $data;

        header("location:" . $view);
    } else
        header("location:" . $view);
}



////////////////Recive Data From redirect Function////
function receive($name)
{
    /*
    param name => passed data name to redirect function ^
    example => redirect("login",$tmp, "PassedData");
    $catch=receive("PassedData");
    */
    if (isset($_SESSION[$name])) {
        $tmp = $_SESSION[$name];
        unset($_SESSION[$name]);
        return $tmp;
    }
}


/////////////////// Check Login Status /////
function loggedin()
{
    if (isset($_SESSION["Type"]))
        switch ($_SESSION['Type']) {
            case 'C':
                header("location: ../../profiles/ameeen/");
                //if user type is B then this user profile is in page leader.php
            case 'B':
                header("location: ../../profiles/leaders/");
                //if user type is C then this user profile is in page ameeen.php
            case 'A':
                header("location: ../../profiles/members/");
        }
}
