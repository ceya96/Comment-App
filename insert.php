<?php
// Create connection
$conn = new mysqli("localhost", "root", "", "kommentare");
// Check connection
 if ($conn->connect_error)
    exit();

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
// define variables and set to empty values
$variable1Err = "";
$variable1 = "";
$variable2Err = "";
$variable2 = "";

if (empty($_POST["username"]) && (empty($_POST["comment"]))){
    $variable1Err = "Bitte tragen Sie Ihren Namen ein";
    $variable2Err = "Bitte schreiben Sie einen Kommentar";
}
elseif (empty($_POST["username"])) {
    $variable1Err = "Bitte tragen Sie Ihren Namen ein";
}
elseif (empty($_POST["comment"])) {
    $variable2Err = "Bitte schreiben Sie einen Kommentar";
}
else {
    $objComment = new Comment()->send();
    // ToDo: Mit Constructor möglich
    $objComment->name = 'yasin';


    $objComment->submit();


    $variable2 = $_POST["comment"];
    $variable1 = $_POST["username"];
    $variable3 = $_POST["email"];
    $stmt = $conn->prepare("INSERT INTO kommentare (Email, name, kommentare) VALUES (?,?,?)");
     //"s" means the database expects a string
    $stmt->bind_param('sss', $variable3, $variable1, $variable2);
    $stmt->execute();
}
header("Location: index.php");
