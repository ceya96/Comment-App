<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="answers.css">
    <script src="tinymce_6.7.0/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
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
            <button class="button" name="submit" id="answerbtn" type="submit" ">
                senden
            </button>
        </form>
        <span>
             <?php
             require 'Database.php';
             require 'Comment.php';
             $connection = new Database();
             $comment = new Comment();

             if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["submit"])) {
                 $newtext = $_POST["comment"];
                 $newname = $_POST["username"];
                 $newemail = $_POST["email"];

                 $comment->set($newname, $newemail, $newtext);
             }
             ?>
        </span>
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

