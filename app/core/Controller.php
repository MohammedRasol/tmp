<?php

class Controller
{
    public function index()
    {
        echo "SUPER INDEX";
    }

    protected function model($model)
    {
       require_once("../app/models/" .$model.".php");
       return new $model();
    }

    public function view ($view,$NAVIGATE=[]){
        require_once("../app/Views/"   . $view. ".php" );
    }
}
