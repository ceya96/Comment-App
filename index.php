<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="custom.css">
    <script src="tinymce_6.7.0/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="main.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kommentar Übung</title>
</head>
<body>
    <div class="container">
        <h2 class="header">
            Hinterlasse eine Nachricht!
        </h2>
        <div class="container-form">
            <form method= "POST" action="">
                <label for="name"></label>
                <input type="text" id="name" name="username" required placeholder=" Dein Name">
                <br>
                <br>
                <label for="email"></label>
                <input type="email" id="email" name="email"  required placeholder="Deine E-Mail">
                <br>
                <br>
                <label for="comment"></label>
                <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Deine Nachricht"></textarea>
                <button class="button" name="submit" id="btn" type="submit">
                    senden
                </button>
                <h2>
                    Kommentare
                </h2>
                <div class="comment-box">
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
                            header("Location: index.php");
                        }

                        $comment->get();
                        ?>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <script>
        let input = document.getElementById("input");
        input.addEventListener("keypress", enter)

        function enter(senden) {
        if (senden.key === "Enter") {
            senden.preventDefault();
            document.getElementById("btn").click();
        }
        }
</script>

</body>

