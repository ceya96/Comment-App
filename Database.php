<?php

class Database
{
    public $connection;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli("localhost", "root", "", "kommentare");
        //Todo: throw error message
        if ($this->connection->connect_error)
        {
            exit();
        }
    }
    //Todo: refactor the function insert that it expects the table and an array
    public function insert($newname, $newemail, $newtext, $parentId)
    {
        $sql = $this->connection->prepare("INSERT INTO kommentare (name, email, text, pid) VALUES (?,?,?,?)");
        $sql->bind_param('sssi', $newname, $newemail, $newtext, $parentId);
        $sql->execute();

        ($this->connection)->close();
    }
    public function select()
    {
        $sql = $this->connection->prepare("SELECT email, name, text, id, pid, tstamp FROM kommentare ORDER BY tstamp DESC ");
        $sql->execute();
        $result = $sql->get_result();
        return $result;
    }
}
