<?php
class User extends Model
{
    public $name;

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
}
