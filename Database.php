<?php

class Database
{
    public $connection;

    public function __construct($hostname,  $username, $password, $database)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli("$hostname", "$username", "$password", "$database");
        if ($this->connection->error)
        {
            exit('Es konnte keine Verbindung hergestellt werden');
        }
    }
}