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
    <h2>
        Antwort
    </h2>
    <div class="container-form">
        <form method= "POST" >
            <label for="comment"></label>
            <textarea id="comment" name="comment" rows="4" cols="50" placeholder="Deine Antwort"></textarea>
            <button class="button" name="submit" id="btn" type="submit"  onClick="window.location.reload()">
                senden
            </button>
        </form>
    </div>
</div>
<script>
    let input = document.getElementsByClassName("tox tox-tinymce tox-tinymce--toolbar-bottom");
    input.addEventListener("keypress", enter)

    function enter(senden) {
        if (senden.key === "Enter") {
            senden.preventDefault();
            document.getElementById("btn").click();
        }
    }
</script>

</body>

