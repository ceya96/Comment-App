<?php

class User
{
    private Database $db;
    private string $name;
    private string $email;
    private string $password;

    public function __construct() //
    {
        $this->db = new Database("localhost", "root", "", "kommentare");
    }

    function setData($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }
    function setName($name):void
    {
        $this->name = $name;
    }
    function setEmail($email):void
    {
        $this->email = $email;
    }
    function setText($password):void
    {
        $this->password = $password;
    }

    function save()
    {
        $sql = $this->db->connection->prepare("INSERT INTO users (username, email, password) VALUES (?,?,?)");
        $sql->bind_param('sss', $this->name, $this->email, $this->password);
        $sql->execute();

        $this->db->connection->close();
    }

}