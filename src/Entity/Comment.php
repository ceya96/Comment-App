<?php

namespace CommentaryApp\Entity;

require_once __DIR__ . '/../../src/Database/Database.php';

use CommentaryApp\Database\Database;

class Comment
{
    private Database $db;
    private int $parentId;
    private int $commentId;
    public $username;
    public $userID;
    public $text;
    public $tstamp;

    public function __construct(int $commentId = 0) //
    {
        $this->commentId = $commentId;
        $this->db = new Database("localhost", "root", "", "kommentare");
        if ($commentId) {
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

    public function setParent(int $parentId = 0): void
    {
        $this->parentId = $parentId;
    }

    public function save(): void
    {
        if ($this->commentId) {
            //update
            $sql = $this->db->connection->prepare("UPDATE kommentare SET name = ?, email = ?, text = ?, pid = ? WHERE id = ?");
            $sql->bind_param('sssi', $this->name, $this->email, $this->text, $this->parentId);
            $sql->execute();

            $this->db->connection->close();
        } else {
            //insert
            $sql = $this->db->connection->prepare("INSERT INTO kommentare (userID, text, pid) VALUES (?,?,?)");
            $sql->bind_param('isi', $this->userID, $this->text, $this->parentId);
            $sql->execute();

            $this->db->connection->close();
        }
    }

    function setData($username, $userID, $text): void
    {
        $this->username = $username;
        $this->userID = $userID;
        $this->text = $text;
    }

    function setUserID($userID): void
    {
        $this->userID = $userID;
    }

    function setUsername($username): void
    {
        $this->username = $username;
    }

    function setText($text): void
    {
        $this->text = $text;
    }

    function getData(): array
    {
        $data = [
            'username' => $this->username,
            'userID' => $this->userID,
            'text' => $this->text
        ];
        return $data;
    }
}

