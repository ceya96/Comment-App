<?php

class Database
{
    public $connection;

    public function __construct()
    {
        $this->connection = new mysqli("localhost", "root", "", "kommentare");

        if ($this->connection->connect_error) {
            exit();
        }
    }

    public function insert($newname, $newemail, $newtext)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $sql = $this->connection->prepare("INSERT INTO kommentare (name, email, text) VALUES (?,?,?)");
        $sql->bind_param('sss', $newname, $newemail, $newtext);
        $sql->execute();

        if (isset($_REQUEST['pid'])) //REQUEST da POST keine pid mitschickt sondern über REQUEST in Query-String
        {
            $objStatement = $this->connection->prepare('SELECT MAX(id) FROM kommentare');
            $objStatement->execute();

            $objResult = $objStatement->get_result();
            $arrResult = $objResult->fetch_all();

            // Nur der aller erste Wert aus der ersten Reihe
            $current_id = reset($arrResult)[0] ?? 0; //wenn reset($arrResult)[0] nicht exisitiert ist es -> 0

            $parent_id = (int) $_GET['pid'];
            $sql2 = $this->connection->prepare("UPDATE kommentare SET pid = $parent_id WHERE id = $current_id");
            $sql2->execute();
        }

        ($this->connection)->close();
    }
    public function select()
    {
        $sql = $this->connection->prepare("SELECT email, name, text, id, pid FROM kommentare ORDER BY tstamp DESC ");
        $sql->execute();
        $result = $sql->get_result();
        return $result;
    }
}
