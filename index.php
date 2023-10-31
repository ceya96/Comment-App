<?php

require 'Database.php';
require 'Comment.php';
require 'CommentForm.php';
require 'CommentList.php';
$comment = new Comment;
$commentForm = new CommentForm('submitForm');
$commentList = new CommentList;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="custom.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kommentar Übung</title>
</head>
<body>
    <a id="exit" onclick="">&#9587;</a>
    <div id="containerid" class="container">
        <h2 class="header">
            Hinterlasse eine Nachricht!
        </h2>
        <div class="container-form">
            <form id="input" name="myform" method= "POST" action="">
                <input type="hidden" name="formID" value="MEIN_FORM" />
                <label for="name"></label>
                <input type="text" id="name" name="username" required placeholder=" Dein Name">
                <br>
                <br>
                <label for="email"></label>
                <input type="email" id="email" name="email"  required placeholder="Deine E-Mail">
                <br>
                <br>
                <label for="comment"></label>
                <textarea id="comment" name="comment" rows="5.5"  placeholder="Deine Nachricht"></textarea>
                <button class="button" name="submitForm" id="btn" type="submit">
                    senden
                </button>
                <button id="preCodeBtn" class="button" name="precode" type="button">
                    ArrayCode
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
                            <li>
                                <?php echo $comment['name']; ?>
                                <p><?php echo $comment['text']; ?></p>
                                <!-- if there is a answer in the answer-key stored, echo it as well -->
                                <?php if (!empty($comment['answers'])) { ?>
                                    <ul>
                                        <?php foreach ($comment['answers'] as $answer) { ?>
                                            <li>
                                                <?php echo $answer['name']; ?>
                                                <p><?php echo $answer['text']; ?></p>
                                            </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                            </li>
                        <?php } ?>   
                    </ul> 
                </div>
            </form>
        </div>
    </div>
    <script src="main.js"></script>
</body>

