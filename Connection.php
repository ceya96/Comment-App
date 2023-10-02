<?php

class Connection
{
    public $hostname;
    public $username;
    public $password;
    public $database;

    public function __construct($newhostname, $newusername, $newdatabase){
        $this->hostname = $newhostname;
        $this->username = $newusername;
        $this->database = $newdatabase;

        $sql = new mysqli("localhost", "root", "", "kommentare");
        if ($sql == true){
            return true;
        }
        else {
            $sql->connect_error;
                exit();
        }
    }

}
