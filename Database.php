<?php

class Database
{
    public $connection;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli("localhost", "root", "", "kommentare");
        if ($this->connection->error)
        {
            exit('Es konnte keine Verbindung hergestellt werden');
        }
    }
}