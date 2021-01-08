<?php
class Home extends Controller
{

    public function index($name = "")
    {

        $this->view('home/index');
    }
    public function show()
    {
        echo "SHOWED";
    }
}
?>