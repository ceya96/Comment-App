<?php

class CommentList
{
    private Database $db;

    public function __construct()
    {
        $this->db = new Database();
    }
    public function getAll():array //Todo $arrResult soll ungefilter alle Kommentare ausgeben  und eine weitere Methode soll diese verschalten und ordnen , quasi dass was ich gebaut habe nur ist meine Methode nur dafür da 2 Level Kommentare und Antworten zu bauen und die neue Methode übernimmt auch quasi Antwort auf Antwort
    {
        //Array output
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
        return $allComments;

        ($this->db->connection)->close();
    }
        
}
//KOMMENTAR-> HTML durch platzhalter in festgeschriebene Templates erzeugen??
//Ähnlich  wie bei Contao  Erweiterungen (?)