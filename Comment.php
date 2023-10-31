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
    public function save()
    {
        if ($this->commentId)
        {
            //update
            $sql = $this->db->connection->prepare("UPDATE kommentare SET name = ?, email = ?, text = ?, pid = ? WHERE id = ?");
            $sql->bind_param('sssi', $this->name, $this->email, $this->text, $this->parentId);
            $sql->execute();
            
            $this->db->connection->close();
        }
        else
        {
            //insert
            $sql = $this->db->connection->prepare("INSERT INTO kommentare (name, email, text, pid) VALUES (?,?,?,?)");
            $sql->bind_param('sssi', $this->name, $this->email, $this->text, $this->parentId);
            $sql->execute();

            $this->db->connection->close();
        }
    }

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
            'name'   => $this->name,
            'email'  => $this->email,
            'text'   => $this->text,
            'id'     => $this->commentId,
            'tstamp' => $this->tstamp,
        ];
        return $data;
    }

    public function get(): array
    {
        $sql = $this->db->connection->prepare("SELECT email, name, text, id, pid, tstamp FROM kommentare WHERE pid = 0 ORDER BY tstamp DESC ");
        $sql->execute();
        $commentResult = $sql->get_result();

        $sql = $this->db->connection->prepare("SELECT email, name, text, id, pid, tstamp FROM kommentare WHERE pid != 0 ORDER BY tstamp DESC ");
        $sql->execute();
        $answerResult = $sql->get_result();

        $answers = [];
        $comments = [];

        while ($answer = $answerResult->fetch_assoc())
        {
            if(!array_key_exists($answer['pid'], $answers))
            {
                $answers[$answer['pid']] = [$answer];
            }
            else
            {
                $answers[$answer['pid']][] = $answer;
            }
        }

        while ($comment = $commentResult->fetch_assoc())
        {
            if(array_key_exists($comment['id'], $answers)) 
            {
                $comment['answers'] = $answers[ $comment['id'] ];
            }

            $comments[] = $comment;
        }

        $this->db->connection->close();

        return $comments;
    }
}

