<?php
                        require 'Database.php';
                        require 'Comment.php';
                        require 'CommentForm.php';
                        $comment = new Comment();
                        $commentForm = new CommentForm('submitForm');
                        //$comment = new Comment();




                       /* // Kommentar-Formular Instanz erzeugen
                        $form = new CommentForm();

                        // Formularfelder zur Verfügugn stellen
                        $form->setFormFields([
                                [
                                        'name'      => 'feldname',
                                        'label'     => 'Name',
                                        'type'      => 'text',
                                        'require'   => true
                                ],
                                [
                                        'name'      => 'feldname2',
                                        'label'     => 'Name 2',
                                        'type'      => 'text',
                                        'require'   => true
                                ]
                        ]);

                        // Durch weitere Logic ist es möglich Felder dynamisch hinzuzufügen
                        if($logic === 'Kunde möchte bei Auswahl von Checkbox A, ein weiteres Feld abfragen')
                        {
                            $form->setFormFields([
                                [
                                    'name'      => 'weiteresfeld',
                                    'label'     => 'Name',
                                    'type'      => 'text',
                                    'require'   => true
                                ]
                            ]);
                        }

                        // Formular generieren -> HTML Ausgabe
                        echo $form->generateForm();*/

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
                <h2>
                    Kommentare
                </h2>
                <div class="comment-box">
                    <span>
                        <?php
                        $comment->get();
                        ?>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <script src="main.js"></script>
</body>

