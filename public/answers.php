<?php

require_once("header.php");

require '../src/Database/Database.php';
require '../src/Entity/Comment.php';
require '../src/Form/CommentForm.php';

use CommentaryApp\Entity\Comment;
use CommentaryApp\Form\CommentForm;

$commentForm = new CommentForm('submitAnswer', (int) $_REQUEST['pid']);
$answer = new Comment;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/answers.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kommentar Übung</title>
</head>
<body>
<div class="container">
    <h2>
        Antwort
    </h2>
    <div class="container-form">
        <form id="answers" method= "POST" action="">

            <label for="comment"></label>
            <textarea id="comment" name="comment" rows="5.5"  placeholder="Deine Antwort" required></textarea>
            <button class="button" name="submitAnswer" id="answerbtn" type="submit">
                senden
            </button>
        </form>
    </div>
</div>
<script>
    let input = document.getElementById("answers");
    input.addEventListener("keypress", enter)

    function enter(senden) {
        if (senden.key === "Enter") {
            senden.preventDefault();
            document.getElementById("answerbtn").click();
        }
    }
</script>
</body>

