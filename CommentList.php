<?php

class CommentList
{
    private Database $database;

    public function __construct()
    {
        $this->database = new Database();
    }
    public function get()
    {
        $result = $this->database->select();
        $ResultContainer = $this->database->select();
        $arrResult = $ResultContainer->fetch_all();

        $comments = array();
        $answers = array();

        if ($result->num_rows > 0)
        {
            foreach ($arrResult as $key => $value)
            {
                foreach ($value as $datakey => $data)
                {
                    if ($datakey == 4)
                    {
                        if($data === 0)
                        {
                            array_push($comments, $value);
                        }
                        else
                        {
                            array_push($answers, $value);
                        }
                    }
                }
            }
            $answersSorted = array_reverse($answers);
            while ($row = $result->fetch_assoc())
            {
                if ($row["pid"] === 0)
                {
                    //Todo: generate the HTML inside the HTML not in php | pass the comments via Array containers
                    echo "<div class='author-container'>" . "<span class='author'>" . $row["name"] . "<span class='author-mail'>" . " (" . $row["email"] . ")" . "</span>" . "<span class='author-tstamp'>" . $row["tstamp"] . "</span>". "</div>" . "<p>" . $row["text"] . "</p>";
                    foreach ($answersSorted as $key_answer => $value_answer)
                    {
                        foreach ($value_answer as $datakey_answer => $data_answer)
                        {
                            if ($datakey_answer == 4)
                            {
                                if($data_answer == $row["id"])
                                {
                                    echo "<div class='container-answers' onmouseover='showDelete(this)' onmouseout='hideDelete(this)'>"."<span class='response-arrow'>". "&#8627;". "</span>"."<div class='author-container-answers'>" . "<span class='author_answers'>" . $value_answer[1] . "</span>" . "<span class='author-mail-answers'>" . " (" . $value_answer[0] . ")" . "</div>" . "<p>" . $value_answer[2] . "</p>". "<button id='deleteBtn' type='button' class='delete-btn'>&#215;</button>". "</div>";
                                }
                            }
                        }
                    }
                    echo "<button type='button' class='answer-btn' data-id= {$row['id']} onclick='openAnswer(this)'>Antworten</button>";
                }
            }
            //TEST the arrays
            /* echo "<br>";
            echo "<br>";
            echo "Kommentare Array:"."<br>";
            print_r($comments);
            echo "<br>";
            echo "<br>";
            echo "Antworten Array:"."<br>";
            print_r($answers);*/
        }
        else
        {
            echo "<div'><p>Keine Kommentare verfügbar</p></div>";
        }

        ($this->database->connection)->close();
    }
}