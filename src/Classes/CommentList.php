<?php

namespace CommentaryApp\Classes;

require_once __DIR__ . '/../../src/Database/Database.php';

use CommentaryApp\Database\Database;

class CommentList
{
    private Database $db;

    function __construct()
    {
        $this->db = new Database("localhost", "root", "", "kommentare");
    }

    function getAll(): array
    {
        //Get comments from Database
        $sql = $this->db->connection->prepare("SELECT kommentare.id, kommentare.text, kommentare.tstamp, kommentare.pid, kommentare.userid, users.username
        FROM kommentare
        LEFT JOIN users ON kommentare.userid = users.userid
        WHERE pid = 0 ORDER BY tstamp DESC");
        $sql->execute();
        $commentResult = $sql->get_result();
        //Get answers from Database
        $sql = $this->db->connection->prepare("SELECT kommentare.id, kommentare.text, kommentare.tstamp, kommentare.pid, kommentare.userid, users.username
        FROM kommentare
        LEFT JOIN users ON kommentare.userid = users.userid
        WHERE pid != 0 ORDER BY tstamp ASC");
        $sql->execute();
        $answerResult = $sql->get_result();

        $answers = [];
        $comments = [];

        //fetch answer container and fill the $answers container in order
        while ($answer = $answerResult->fetch_assoc()) {
            if (!array_key_exists($answer['pid'], $answers)) {
                //add new key and create new array (2. dimension) and push directly the value
                $answers[$answer['pid']] = [$answer];
            } else {
                //add new value under given key
                $answers[$answer['pid']][] = $answer;
            }
        }

        //Append the answer array to the right comment and push it as whole in the final $comments container
        while ($comment = $commentResult->fetch_assoc()) {
            if (array_key_exists($comment['id'], $answers)) {
                $comment['answers'] = $answers[$comment['id']];
            }

            $comments[] = $comment;
        }

        $this->db->connection->close();

        return $comments;
    }
}


/* //Array output
$sql = $this->db->connection->prepare("SELECT email, name, text, id, pid, tstamp FROM kommentare WHERE pid = 0 ORDER BY tstamp DESC");
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
        {
            $response = [];
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
                            $row['answers'][] = $response;
                        }
                    }
                }
            }
            array_push($allComments, $row);
        }
    }
}
else
{
    //no comments available
}
printf('<pre id="code" class="code">%s</pre>', print_r($allComments, true));

($this->db->connection)->close();

return $allComments; */
/* } */

/* } */
//KOMMENTAR-> HTML durch platzhalter in festgeschriebene Templates erzeugen??
//Ähnlich  wie bei Contao  Erweiterungen (?)