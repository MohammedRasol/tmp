<?php

class Database
{

    private $username, $dbname, $password, $host;
    public $connect;
    public  function __construct()
    {
        $this->username = "";
        $this->dbname = "";
        $this->password = "";
        $this->host = "";
    }

    public function ConnectToDataBase()
    {
        $this->connect =  new mysqli($this->host, $this->username,$this->password,$this->dbname);
        return $this->connect;
    }

    
    public function DisconnectDataBase()
    {
        $this->connect->close();
    }


}
?>
