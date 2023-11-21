<?php

namespace CommentaryApp\Form;

require_once __DIR__ . '/../../src/Entity/Comment.php';

use CommentaryApp\Entity\Comment;

class CommentForm
{

    public function __construct(string $submitName, int $parentId = 0)
    {
        $this->handleSubmit($submitName, $parentId);
    }

    private function handleSubmit(string $submitName, int $parentId): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$submitName"])) {
            $comment = new Comment();
            $comment->setData($_SESSION['username'], $_SESSION['userID'], $_POST['comment']);
            $comment->setParent($parentId);
            $comment->save();
        }
        if (isset($_POST["submitForm"])) {
            header("Location: index.php");
        }
    }
}