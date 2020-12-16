<?php
class Home extends Controller {

    public function index ($name="")
    {
        $user=$this->model("User");
        $user->name=$name;
        $conn= $user->ConnectToDataBase();

        $res = mysqli_query($conn, "select * from user ") ;
        
        $user->DisconnectDataBase();
        $this->view('home/index' ,['name'=> $res->num_rows]);
    }
   
}