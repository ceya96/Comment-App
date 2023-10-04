<?php

class Database
{
    public $connection;
    public function __construct()
    {
        $this->connection = new mysqli("localhost", "root", "", "kommentare");

        if ($this->connection->connect_error)
        {
            exit();
        }
    }

    public function insert($newname, $newemail, $newtext)
    {
        $sql = $this->connection->prepare("INSERT INTO kommentare (name, Email, kommentare) VALUES (?,?,?)");
        $sql->bind_param('sss',$newname, $newemail, $newtext);
        $sql->execute();
        ($this->connection)->close();

    }
    public function select()
    {
        $sql = $this->connection->prepare("SELECT Email, name, kommentare FROM kommentare ORDER BY erstellt_am DESC ");
        $sql->execute();
        $result = $sql->get_result();
        return  $result;
    }
}
