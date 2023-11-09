<?php

require_once("header.php");
//require '../src/Database/Database.php';
//require '../src/Entity/Comment.php';
require '../src/Classes/CommentList.php';
require '../src/Form/CommentForm.php';

use CommentaryApp\Form\CommentForm;
use CommentaryApp\Classes\CommentList;

$commentForm = new CommentForm('submitForm');
$commentList = new CommentList();

//protect the index.php
if (!isset($_SESSION['username']))
{
    header("Location: login.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/custom.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kommentar Übung</title>
</head>
<body>
    <a id="exit" onclick="">&#9587;</a>
    <div id="containerid" class="container">
        <h2 class="header">
            Hallo <?= $_SESSION['username']; ?>!
            <br>
            <br>
            Hinterlasse eine Nachricht
        </h2>
        <div class="container-form">
            <form id="input" name="myform" method= "POST" action="">
                <label for="comment"></label>
                <textarea id="comment" name="comment" rows="5.5"  placeholder="Deine Nachricht"></textarea>
                <button class="button" name="submitForm" id="btn" type="submit">
                    senden
                </button>
                <h2>
                    Kommentare
                </h2>
                <div class="comment-box">                   
                    <?php
                    //store the returned $comments array in a variable
                    $comments = $commentList->getAll();
                    ?>
                    <ul>
                        <?php foreach ($comments as $comment) { ?>
                            <li class="commentList">
                                <p class="username"><?= $comment['username']; ?>:</p>
                                <p class="comment" ><?= $comment['text']; ?></p>
                                <!-- if there is a answer in the answer-key stored, echo it as well -->
                                <?php if (!empty($comment['answers'])) { ?>
                                    <ul>
                                        <?php foreach ($comment['answers'] as $answer) { ?>
                                            <li>
                                                <p class="username-answer"><?= $answer['username']; ?>:</p>
                                                <p class="answer"><?= $answer['text']; ?></p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                <button type='button' class='answer-btn' data-id=<?=$comment['id']?> onclick='openAnswer(this)'>Antworten</button>
                            </li>
                        <?php } ?>   
                    </ul> 
                </div>
            </form>
        </div>
    </div>
    <a class="logout" href="logout.php">Abmelden</a>
    <script src="assets/js/main.js"></script>
</body>

