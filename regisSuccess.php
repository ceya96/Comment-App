<?php
if(isset($_POST['toLogin']))
{
    header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="registration.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration erfolgreich</title>
</head>
<body>

<div id="containerid" class="container">
    <h2 class="header">
        Ihre Registrierung war erfolgreich 🎉
    </h2>
    <div class="container-form">
        <form name="backToLogin" method= "POST" action="">
            <button class="button" name="toLogin" id="btn" type="submit">
                Zum Login
            </button>
        </form>
    </div>
</div>
</body>
