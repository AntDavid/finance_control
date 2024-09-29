<?php
session_start();
require_once 'conn.php';

class Login extends Conn {
    
    public function verifyLogin($email, $password) {
        $stmt = $this->getConnection()->prepare("SELECT id, name, password FROM users WHERE email = ?");
        
        if (!$stmt) {
            return "Erro na preparação da query: " . $this->getConnection()->error;
        }

        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 0) {
            return "Usuário não encontrado.";
        }

        $stmt->bind_result($id, $name, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['user_id'] = $id;    
            $_SESSION['user_name'] = $name;
            $_SESSION['logged_in'] = true; 

            echo "<script>alert('Login bem-sucedido!'); window.location.href = '../pages/financial_control.php';</script>";
            exit();
        } else {
            return "Senha incorreta.";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $login = new Login();
    $message = $login->verifyLogin($email, $password);

    if ($message !== "Login bem-sucedido!") {
        echo "<script>alert('$message'); window.location.href = '../pages/signon.html';</script>";
    }
}
