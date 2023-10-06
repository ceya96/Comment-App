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
        <form id="answers" method= "POST" >
            <label for="comment"></label>
            <textarea id="comment" name="comment" rows="6"  placeholder="Deine Antwort"></textarea>
            <button class="button" name="submit" id="answerbtn" type="submit" ">
                senden
            </button>
        </form>
    </div>
</div>
<script src="answer.js"></script>
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

