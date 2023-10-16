<?php

class Comment
{
    private Database $database;
    private int $parentId = 0;

    public function __construct()
    {
        $this->database = new Database();
    }

    /**
     * Set the parent comment by id.
     *
     * @return void
     */
    public function setParent(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function save($newname, $newemail, $newtext, $parentId)
    {

        //$this->parentId

        $this->database->insert($newname, $newemail, $newtext, $parentId);
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
                                if($data_answer == $row["id"] )
                                {
                                    echo "<div class='container-answers'>"."<span class='response-arrow'>". "&#8627;". "</span>"."<div class='author-container-answers'>" . "<span class='author_answers'>" . $value_answer[1] . "</span>" . "<span class='author-mail-answers'>" . " (" . $value_answer[0] . ")" . "</div>" . "<p>" . $value_answer[2] . "</p>". "</div>";
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

//Model for view
$answers = [
    '0' => [
        '0' => 'yasin@oveleon.de',
        '1' => 'Yasin',
        '2' => 'Antwort auf LALA',
        '3' => '5',
        '4' => '4',
    ],
    '1' => [
        '0' => 'mitglied3@mustermail.de',
        '1' => 'Sebastian',
        '2' => 'Hallo',
        '3' => '3',
        '4' => '1',
    ],
    '2' => [
        '0' => 'yasin@oveleon.de',
        '1' => 'Yasin',
        '2' => 'Antwort',
        '3' => '3',
        '4' => '1',
    ]
];
/*prototyp*/
/*while ($row = $ResultContainer->fetch_assoc())
        {
          if($row["pid"] === 0)
          {
              array_push($comments, $row);
          }
          else
          {
              array_push($answers, $row);
          }
        }
        print_r($answers);*/
