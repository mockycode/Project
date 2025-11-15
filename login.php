<?php
include 'conexao.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $usuario = $result->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario'] = $usuario['id_usuario'];
            $_SESSION['tipo'] = $usuario['tipo'];
            $_SESSION['nome'] = $usuario['nome'];
           if ($usuario['tipo'] === 'admin') {
                header("Location: admin/admin.php");
            } else {
                header("Location: index.html");
            }
            exit;
        } else {
            echo "Senha incorreta!";
        }
    } else {
        echo "Usuário não encontrado!";
    }
}
?>