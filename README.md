# Commentary


```php
<?php

session_start();
$_SESSION['name'] = "wert";
// Kommentar anlegen first
$comment = new Comment;
$comment->setData($name, $email, $text, $tstamp);
$comment->save();

// Kommentarantwort anlegen checked!
$answer = new Comment;
$answer->setData($name, $email, $text, $tstamp);
$answer->setParent($parentId);
$answer->save();

// Kommentare/Antworten initialisieren (DB) checked
//$comment = Comment::createFromDatabaseId(5);

$comment = new Comment($id);
$comment->name = 'Daniele';
$comment->setName('Daniele');
$comment->save(); //-> INSERT oder UPDATE wie wurde ich initialisiert (ID Abfrage)

//Kommentarformular

// Kommentare ausgeben checked
$comment = new Comment($id);
$commentArray = $comment->getData(); //für viele Usecases entwickeln wenns für einen selbst nicht zeitinteensiv ist

/*Ausgabe der getData Methode*/
/*$comment = [
    'email' => 'yasin@oveleon.de',
    'name' => 'Yasin',
    'text' => 'Antwort auf LALA',
    'id' => '5',
    'pid' => '4',
    'tstamp' => '',
];*/

$commentList = new CommentList;
$allComments = $commenList->getAll();

/*$allComments = [
    '0' => [
        'email' => 'yasin@oveleon.de',
        'name' => 'Yasin',
        'text' => 'Antwort auf LALA',
        'id' => '5',
        'pid' => '4',
        'tstamp' => '',
        'answers' => null
    ],
    '1' => [
        'email' => 'yasin@oveleon.de',
        'name' => 'Yasin',
        'text' => 'Antwort auf LALA',
        'id' => '5',
        'pid' => '4',
        'tstamp' => '',
        'answers' => null
    ],
    '2' => [
        'email' => 'yasin@oveleon.de',
        'name' => 'Yasin',
        'text' => 'Antwort auf LALA',
        'id' => '5',
        'pid' => '4',
        'tstamp' => '',
        'answers' => [
            '0' => [
                'email' => 'yasin@oveleon.de',
                'name' => 'Yasin',
                'text' => 'Antwort auf LALA',
                'id' => '5',
                'pid' => '4',
                'tstamp' => '',
                'answers' => null
            ],
            '1' => [
                'email' => 'yasin@oveleon.de',
                'name' => 'Yasin',
                'text' => 'Antwort auf LALA',
                'id' => '5',
                'pid' => '4',
                'tstamp' => '',
                'answers' => null
            ],
            '2' => [
                'email' => 'yasin@oveleon.de',
                'name' => 'Yasin',
                'text' => 'Antwort auf LALA',
                'id' => '5',
                'pid' => '4',
                'tstamp' => '',
                'answers' => null
            ]
        ]
    ]
];*/
```