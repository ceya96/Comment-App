<?php

namespace CommentaryApp\Form;

require_once __DIR__ . '/../../src/Database/Database.php';

use CommentaryApp\Database\Database;

class LoginForm
{
    private Database $db;

    public function __construct(string $submitName)
    {
        $this->db = new Database("localhost", "root", "", "kommentare");
        $this->handleLogin($submitName);
    }

    private function handleLogin(string $submitName): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$submitName"])) {
            $this->login($_POST['userEmail']);
        }
    }

    private function login(string $email): void
    {
        $stmt = $this->db->connection->prepare("SELECT userID, username, password, email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        //if the username got one result its valid
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify(($_POST['password']), $row['password'])) {
                $_SESSION['username'] = $row['username'];
                $_SESSION['userID'] = $row['userID'];
                $_SESSION['userEmail'] = $row['email'];
                header("Location: index.php");
                exit();
            } else {
                $_SESSION['loginError'] = "Benutzername oder Passwort ungültig";
            }
        } else {
            $_SESSION['loginError'] = "Benutzername oder Passwort ungültig";
        }
    }
}