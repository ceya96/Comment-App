<?php

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
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST["$submitName"]))
        {
            $hashedPassword = password_hash(($_POST['password']), PASSWORD_DEFAULT);
            $this->password = $hashedPassword;
            $this->login($_POST['username']);

        }
    }

    private function login(string $username)
    {
        $stmt = $this->db->connection->prepare("SELECT username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        $result = $stmt->get_result();

        //if the username got one result its valid
        if($result->num_rows == 1)
        {
            $row = $result->fetch_assoc();
            if(password_verify(($_POST['password']), $row['password']))
            {
                $_SESSION['username'] = $row['username'];
                header("Location: index.php");
                exit();
            }
            else
            {
                $_SESSION['loginError']  = "Benutzername oder Passwort ungültig";
            }
        }
        else
        {
            $_SESSION['loginError'] = "Benutzername oder Passwort ungültig";
        }
    }
}