<?php

class CommentList
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAll() //Todo $arrResult soll ungefilter alle Kommentare ausgeben  und eine weitere Methode soll diese verschalten und ordnen , quasi dass was ich gebaut habe nur ist meine Methode nur dafür da 2 Level Kommentare und Antworten zu bauen und die neue Methode übernimmt auch quasi Antwort auf Antwort
    {
        $result = $this->db->select();
        $ResultContainer = $this->db->select();
        $arrResult = $ResultContainer->fetch_all();

        $comments = array();
        $answers = array();

        if ($result->num_rows > 0) {
            foreach ($arrResult as $key => $value) {
                foreach ($value as $datakey => $data) {
                    if ($datakey == 4) {
                        if ($data === 0) {
                            array_push($comments, $value);
                        } else {
                            array_push($answers, $value);
                        }
                    }
                }
            }
        }
        $answersSorted = array_reverse($answers);
        while ($row = $result->fetch_assoc()) {
            $row[] = 'answers';
            if ($row["pid"] === 0) {
                //Todo: generate the HTML inside the HTML not in php | pass the comments via Array containers
                echo "<div class='author-container'>" . "<span class='author'>" . $row["name"] . "<span class='author-mail'>" . " (" . $row["email"] . ")" . "</span>" . "<span class='author-tstamp'>" . $row["tstamp"] . "</span>" . "</div>" . "<p>" . $row["text"] . "</p>";
                foreach ($answersSorted as $key_answer => $value_answer) {
                    foreach ($value_answer as $datakey_answer => $data_answer) {
                        if ($datakey_answer == 4) {
                            if ($data_answer == $row["id"]) {
                                echo "<div class='container-answers' onmouseover='showDelete(this)' onmouseout='hideDelete(this)'>" . "<span class='response-arrow'>" . "&#8627;" . "</span>" . "<div class='author-container-answers'>" . "<span class='author_answers'>" . $value_answer[1] . "</span>" . "<span class='author-mail-answers'>" . " (" . $value_answer[0] . ")" . "</div>" . "<p>" . $value_answer[2] . "</p>" . "<button id='deleteBtn' type='button' class='delete-btn'>&#215;</button>" . "</div>";
                                $row['answers'][] = $value_answer;
                            }
                        }
                    }
                }
                array_push($allComments, $row);
                echo "<button type='button' class='answer-btn' data-id= {$row['id']} onclick='openAnswer(this)'>Antworten</button>";
            } else {
                echo "<div'><p>Keine Kommentare verfügbar</p></div>";
            }

            ($this->db->connection)->close();
        }
    }
}