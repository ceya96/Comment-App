<?php

class CommentForm
{

    public function __construct(string $submitName, int $parentId = 0)
    {
        $this->handleSubmit($submitName, $parentId);
    }

    private function handleSubmit($submitName, int $parentId): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$submitName"]))
        {
            $comment = new Comment();
            $comment->setData($_POST['username'], $_POST['email'], $_POST['comment']);
            $comment->setParent($parentId);
            $comment->save();
        }
        if(isset($_POST["submitForm"]))
        {
            header("Location: index.php");
        }
    }
}