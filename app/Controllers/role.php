<?php
class Role extends Controller
{

    public function index()
    {
        // $this->view('login_regist/login');
    }

    public function members()
    {
        $this->view('roles/members');
    }

    public function ameeen()
    {
        $this->view('roles/ameeen');
    }

    public function leaders()
    {
        $this->view('roles/leaders');
    }
}

?>