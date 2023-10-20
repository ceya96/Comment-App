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
            $comment->setParent($parentId);

            $comment->save(
                $_POST["username"],
                $_POST["email"],
                $_POST["comment"],
                $parentId
            );
        }
        if(isset($_POST["submitForm"]))
        {
            header("Location: index.php");
        }
    }

    /**
     * Set multiple form fields.
     *
     * @return void
     */
   /* public function setFormFields(array $fields): void
    {

    }

    /**
     * Return html form.
     *
     * @return string
     */
    /*public function generateForm(): string
    {

    }*/
}