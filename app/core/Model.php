<?php 
class Model extends Database
{

         public function __construct()
         {
             parent::__construct();
             require_once("../public/standard.php");
             require_once("../app/core/lib/functions.php");
        }
        
        public function view ($view,$NAVIGATE=[]){
            header("location:../login" );
        }
}

