<?php

namespace CommentaryApp\Form;

require_once __DIR__ . '/../../src/Entity/User.php';

use CommentaryApp\Entity\User;

class RegistrationForm
{
    public function __construct(string $submitName)
    {
        $this->handleRegis($submitName);
    }

    private function handleRegis(string $submitName): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$submitName"])) {
            $hashedPassword = password_hash(($_POST['password']), PASSWORD_DEFAULT);
            $user = new User();
            $user->setData($_POST['username'], $_POST['email'], $hashedPassword);
            $user->save();
            header("Location: regisSuccess.php");
        }
    }

}