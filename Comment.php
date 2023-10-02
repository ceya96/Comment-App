<?php

class Comment{
    public $name;
    public $email;
    public $text;

    public function __construct($newname, $newemail, $newtext)
    {
        $this->name = $newname;
        $this->email = $newemail;
        $this->text = $newtext;
        $sql = new Connection()
        $stmt = $sql->prepare("INSERT INTO kommentare (name, Email, kommentare) VALUES (?,?,?)");
        //"s" means the database expects a string
        $stmt->bind_param('sss', $this->name, $this->email, $this->text);
        $stmt->execute();

        header("Location: index.php");
    }
}
