<?php
require_once 'conn.php';

class Signup extends Conn {
    
    public function userRegister($name, $email, $password, $conf_password) {
        if ($password !== $conf_password) {
            return "As senhas não coincidem.";
        }

        $stmt = $this->getConnection()->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            return "Este email já está cadastrado. Por favor, use outro email.";
        }

        $stmt->close();

        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->getConnection()->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");

        if (!$stmt) {
            return "Erro na preparação da query: " . $this->getConnection()->error;
        }

        $stmt->bind_param("sss", $name, $email, $hashed_password);

        if ($stmt->execute()) {
            return "Cadastro realizado com sucesso!";
        } else {
            return "Erro ao cadastrar: " . $stmt->error;
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $conf_password = $_POST['conf_password'];

    $signup = new Signup();
    $message = $signup->userRegister($name, $email, $password, $conf_password);

    echo "<script>alert('$message'); window.location.href = '../pages/signon.html';</script>";
}
