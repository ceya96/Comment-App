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
        if (
            $_SERVER['REQUEST_METHOD'] === 'POST' && 
            isset($_POST["$submitName"]) &&
            isset($_POST["password"]) && //ist passwort gesetzt
            $_POST['password'] !== null //passwort darf nicht null sein 
         ) 
         {
            $this->login($_POST['userEmail']);
        }
    }

    private function login(string $email): void
    {
        $stmt = $this->db->connection->prepare("SELECT userID, username, password, email FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        //Wenn kein Ergebnis vorhanden ist oder das Passwort ist falsch ist
       if(
          !is_array($row = $result->fetch_assoc()) || 
          !password_verify(($_POST['password']), $row['password'] )
       ){
          $this->loginFailed();
          return;
       }
        
       //Login erfolgreich
       $this->loginSuccessful($row);
       return;
    }

    private function loginFailed(): void
    {
        $_SESSION['loginError'] = "Benutzername oder Passwort ungültig";
        return;
    }

    private function loginSuccessful (array $row)
    {
        $_SESSION['username'] = $row['username'];
        $_SESSION['userID'] = $row['userID'];
        $_SESSION['userEmail'] = $row['email'];

        return header("Location: index.php");
    }
}