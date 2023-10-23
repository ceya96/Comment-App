<?php

class Comment
{
    private Database $db;
    private int $parentId = 0;
    private int $commentId;
    public $name;
    public $email;
    public $text;
    public $tstamp;

    public function __construct(int $commentId = 0) //
    {
        $this->commentId = $commentId;
        $this->db = new Database();
        if ($commentId)
        {
            $this->getById();
        }

    }
    private function getById(): void
    {
        //Datenbank abfrage hier
        //Select from Database -> Nach ID die Daten des Kommentares holen, array zurückgeben (fetch etc) dann die Daten zuweisen
        //.
        //.
        //.
        $this->name = ['name'];
        $this->email = $['email'];
        $this->text = $['text'];
        $this->tstamp = $this['tstamp'];
    }

    public function setParent(int $parentId): void
    {
        $this->parentId = $parentId;
    }
    public function save()
    {
        if ($this->commentId)
        {
            //update
        }
        else
        {
            //insert
        }
        //Ausschließlich die connection deiner Datenbankverbindung nutzen, statt $db
        $sql = $this->db->connection->prepare("INSERT INTO kommentare (name, email, text, pid) VALUES (?,?,?,?)");
        $sql->bind_param('sssi', $name, $email, $text, $parentId);
        $sql->execute();

        ($this->connection)->close();
    }
    /*test*/
    function setData($name, $email, $text)
    {
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
    }
    function setName($name):void
    {
        $this->name = $name;
    }
    function setEmail($email):void
    {
        $this->email = $email;
    }
    function setText($text):void
    {
        $this->text = $text;
    }

    function getData():array
    {
        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'text' => $this->text
        ];
        return $data;
    }

    public function get():void
    {
        $sql = $this->db->connection->prepare("SELECT email, name, text, id, pid, tstamp FROM kommentare ORDER BY tstamp DESC ");
        $sql->execute();
        $result = $sql->get_result();

        //$ResultContainer = $result; //eig so muss es gehen -< effizienter da DB nur einmal abgefragt wird
        $sql = $this->db->connection->prepare("SELECT email, name, text, id, pid, tstamp FROM kommentare ORDER BY tstamp DESC ");
        $sql->execute();
        $resultContainer = $sql->get_result();
        $arrResult = $resultContainer->fetch_all();

        $allComments = [];

        $comments = [];
        $answers = [];

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
            $answersSorted = array_reverse($answers); // Sortierung über SQL lösen (ORDER !!) Performance Gründe
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
                                    $row['answers'][] = $value_answer;
                                }
                            }
                        }
                    }
                    array_push($allComments, $row);
                    echo "<button type='button' class='answer-btn' data-id= {$row['id']} onclick='openAnswer(this)'>Antworten</button>";
                }
            }
        }
        else
        {
            echo "<div'><p>Keine Kommentare verfügbar</p></div>";
        }
        echo printf('<pre id="code" class="code">%s</pre>', print_r($allComments, true));

        ($this->db->connection)->close();
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
