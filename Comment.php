<?php

class Comment
{
    private Database $db;
    private int $parentId;
    private int $commentId;
    public $name;
    public $email;
    public $text;
    public $tstamp;
    public $userID;

    public function __construct(int $commentId = 0) //
    {
        $this->commentId = $commentId;
        $this->db = new Database("localhost", "root", "", "kommentare");
        if ($commentId)
        {
            $this->getById();           
        }

    }
    private function getById(): void
    {
        // SQL-Abfrage vorbereiten
        $sql = "SELECT name, email, text, tstamp FROM kommentare WHERE id = ?";
        $statement = $this->db->connection->prepare($sql);
        $statement->bind_param("i", $this->commentId);

        // SQL-Abfrage ausführen
        $statement->execute();

        // Ergebnis abrufen (mit fetch_assoc bekommt man Zeile in assoziativen Array) fetch() holt die mit bind_result zugewiesenen Variablen ab, dass Sie auch darüber genutzt werden können
        $statement->bind_result($name, $email, $text, $tstamp);
        $statement->fetch();

        // Daten den Eigenschaften zuweisen
        $this->name = $name;
        $this->email = $email;
        $this->text = $text;
        $this->tstamp = $tstamp;

        // Verbindung schließen
        $statement->close();
        $this->db->connection->close();
    }

    public function setParent(int $parentId= 0): void
    {
        $this->parentId = $parentId;
    }
    public function save():void
    {
        if ($this->commentId)
        {
            //update
            $sql = $this->db->connection->prepare("UPDATE kommentare SET name = ?, email = ?, text = ?, pid = ? WHERE id = ?");
            $sql->bind_param('sssi', $this->name, $this->email, $this->text, $this->parentId);
            $sql->execute();
            
            $this->db->connection->close();
        }
        elseif($userID)
        {
            //insert
            $sql = $this->db->connection->prepare("INSERT INTO kommentare (userId, text, pid) VALUES (?,?,?)");
            $sql->bind_param('isi', $userID, $this->text, $this->parentId);
            $sql->execute();

            $this->db->connection->close();
        }
    }

    function setData($userID, $text)
    {
        $this->userID = $userID;
        $this->text = $text;
    }
    function setUserID($userID):void
    {
        $this->userID = $userID;
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

        //$ResultContainer = $result;
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
            $answersSorted = array_reverse($answers);
            while ($row = $result->fetch_assoc())
            {
                if ($row["pid"] === 0)
                {$response = [];
                    echo "<div class='author-container'>" . "<span class='author'>" . $row["name"] . "<span class='author-mail'>" . " (" . $row["email"] . ")" . "</span>" . "<span class='author-tstamp'>" . $row["tstamp"] . "</span>". "</div>" . "<p>" . $row["text"] . "</p>";
                    foreach ($answersSorted as $key_answer => $value_answer)
                    {
                        foreach ($value_answer as $datakey_answer => $data_answer)
                        {
                            
                            if ($datakey_answer == 0) 
                            {
                                $response['email'] = $data_answer;
                            } 
                            if ($datakey_answer == 1) {
                                $response['name'] = $data_answer;
                            } 
                            if ($datakey_answer == 2) 
                            {
                                $response['text'] = $data_answer;
                            } 
                            if ($datakey_answer == 3) 
                            {
                                $response['id'] = $data_answer;
                            } 
                            if ($datakey_answer == 4)
                            {
                                $response['pid'] = $data_answer;
                                if($data_answer == $row["id"])
                                {
                                    echo "<div class='container-answers' onmouseover='showDelete(this)' onmouseout='hideDelete(this)'>"."<span class='response-arrow'>". "&#8627;". "</span>"."<div class='author-container-answers'>" . "<span class='author_answers'>" . $value_answer[1] . "</span>" . "<span class='author-mail-answers'>" . " (" . $value_answer[0] . ")" . "</div>" . "<p>" . $value_answer[2] . "</p>". "<button id='deleteBtn' type='button' class='delete-btn'>&#215;</button>". "</div>";
                                    $row['answers'][] = $response;
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
        printf('<pre id="code" class="code">%s</pre>', print_r($allComments, true));

        ($this->db->connection)->close();
    }
}

//pushtest

