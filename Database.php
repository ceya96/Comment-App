<?php

class Database
{
    public $connection;

    public function __construct()
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->connection = new mysqli("localhost", "root", "", "kommentare");
        if ($this->connection->connect_error)
        {
            throw new Exception('Es konnte keine Verbindung hergestellt werden');
            exit();
        }
    }
    public function insert($name, $email, $text, $parentId)
    {
        $sql = $this->connection->prepare("INSERT INTO kommentare (name, email, text, pid) VALUES (?,?,?,?)");
        $sql->bind_param('sssi', $name, $email, $text, $parentId);
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
