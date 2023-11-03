<?php
require_once("header.php");
$_SESSION['username'] = "";

require_once("header.php");
require 'Database.php';
require 'RegistrationForm.php';
require 'User.php';

$regisForm = new RegistrationForm('submitRegis');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="registration.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
</head>
<body>

    <div id="containerid" class="container">
        <h2 class="header">
            Registrier dich jetzt
        </h2>
        <div class="container-form">
            <form id="input" method= "POST" action="">
                <label for="name"></label>
                <input type="text" id="name" name="username" required placeholder=" Dein Name">
                <label for="email"></label>
                <input type="email" id="email" name="email"  required placeholder="Deine E-Mail">
                <label for="password"></label>
                <input type="password" id="password" name="password"  required placeholder="Dein Passwort">
                <input type="checkbox" name="checkbox" onclick="showPassword()">
                <label id="passwordLabel" for="checkbox">Passwort anzeigen</label>
                <button class="button" name="submitRegis" id="btn" type="submit">
                    Registrieren
                </button>
            </form>
        </div>
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
