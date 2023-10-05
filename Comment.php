<?php

class Comment
{
    private $database;

    public function __construct()
    {
        $this->database = new Database();
    }

    public function set($newname, $newemail, $newtext,)
    {
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        $this->name = $newname;
        $this->email = $newemail;
        $this->text = $newtext;

        $this->database->insert($newname, $newemail, $newtext);
    }

    public function get()
    {
        $result = $this->database->select();
        if ($result->num_rows > 0)
        {
            while ($row = $result->fetch_assoc())
            {
                echo "<div class='author-container'>" ."<span class='author'>" . $row["name"] . "</span>" . "<span class='author-id'>". " (" . $row["id"] . ")"."</span>". "<span class='author-mail'>". " (" . $row["email"] . ")"."</span>"."</div>" . $row["text"] . "<a href='answers.php'>Antworten</a>" . "<br>";
                //Todo vsprintf recherchieren
                /*echo vsprintf('<br><h1 class="author">%s</h1><br>%s', [
                   'Yasin',
                    'vsprintf-Funktion'
                ]);*/
            }
        }
        else
        {
            echo "Keine Kommentare verfügbar";
        }
        ($this->database->connection)->close();
    }
}
