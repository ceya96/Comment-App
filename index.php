<?php
require_once("header.php");

require 'Database.php';
require 'Comment.php';
require 'CommentForm.php';
require 'CommentList.php';
$commentForm = new CommentForm('submitForm', $_SESSION['user_id']);
$commentList = new CommentList;

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
    <link rel="stylesheet" href="custom.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kommentar Übung</title>
</head>
<body>
    <a id="exit" onclick="">&#9587;</a>
    <div id="containerid" class="container">
        <h2 class="header">
            Hallo <?php echo $_SESSION['username']; ?>
            <br>
            <br>
            Hinterlasse eine Nachricht!
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
                            <li>
                                <?php echo $comment['username']; ?>
                                <p><?php echo $comment['text']; ?></p>
                                <button type='button' class='answer-btn' data-id= $comment['id'] onclick='openAnswer(this)'>Antworten</button>
                                <!-- if there is a answer in the answer-key stored, echo it as well -->
                                <?php if (!empty($comment['answers'])) { ?>
                                    <ul>
                                        <?php foreach ($comment['answers'] as $answer) { ?>
                                            <li>
                                                <?php echo $answer['username']; ?>
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
    <a href="logout.php">Abmelden</a>
    <script src="main.js"></script>
</body>

