<?php
require 'Database.php';
require 'Comment.php';
require 'CommentForm.php';
$commentForm = new CommentForm('submitAnswer', (int) $_REQUEST['pid']);
$answer = new Comment;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="answers.css">
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
            <label for="name"></label>
            <input type="text" id="name" name="username" required placeholder=" Dein Name">
            <br>
            <br>
            <label for="email"></label>
            <input type="email" id="email" name="email"  required placeholder="Deine E-Mail">
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

