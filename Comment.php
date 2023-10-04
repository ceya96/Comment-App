<?php

class Comment
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function set($newname, $newemail, $newtext)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->name = $newname;
        $this->email = $newemail;
        $this->text = $newtext;

        $this->database->insert($newname, $newemail, $newtext);

    }
    public function get()
    {   $result = $this->database->select();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo $row["name"] . " (" . $row["Email"] . ")" . ": " . $row["kommentare"] . "<br>";
            }
        } else {
            echo "Keine Kommentare verfügbar";
        }
        ($this->database->connection)->close();
    }
}
