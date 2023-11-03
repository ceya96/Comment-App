<?php

class RegistrationForm
{
    public function __construct(string $submitName)
    {
        $this->handleRegis($submitName);
    }

    private function handleRegis(string $submitName): void
    {
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$submitName"]))
        {
            $user = new User();
            $user->setData($_POST['username'], $_POST['email'], $_POST['password']);
            $user->save();
            header("Location: index.php");
        }
    }

}