<?php

require_once("header.php");

require "../src/Database/Database.php";
require "../src/Form/LoginForm.php";

use CommentaryApp\Form\LoginForm;

$login = new LoginForm("submitLogin");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="assets/css/registration.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>

<div id="containerid" class="container">
    <h2 class="header">
        Login
    </h2>
    <div class="container-form">
        <form id="input" method= "POST" action="">
            <label for="email"></label>
            <input type="email" id="email" name="userEmail" required placeholder="E-Mail">
            <label for="password"></label>
            <input type="password" id="password" name="password"  required placeholder="Passwort">
            <input type="checkbox" name="checkbox" onclick="showPassword()">
            <label id="passwordLabel" for="checkbox">Passwort anzeigen</label>
            <button class="button" name="submitLogin" id="btn" type="submit">
                Anmelden
            </button>
        </form>
        <?php if (isset($_SESSION['loginError'] )): ?>
        <p class="loginError"><?php echo $_SESSION['loginError']; ?></p>
        <?php endif; ?>

    </div>
    <p class="registrationClick">Noch nicht registriert? Klicke<a href="registration.php"> hier</a></p>
</div>
<script>
    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
</body>