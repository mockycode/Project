<?php
session_start();

// Conexão com o banco de dados
$host = 'localhost';
$usuario = 'root';
$senha_db = ''; // senha padrão do XAMPP é vazia
$banco = 'meu_login';

$conn = new mysqli($host, $usuario, $senha_db, $banco);

// Verifica conexão
if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

// Dados do formulário
$email = $_POST['email'] ?? '';
$senha = $_POST['senha'] ?? '';

// Consulta ao banco
$sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $senha);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $_SESSION['usuario'] = $email;
    header("Location: index.html");
    exit();
} else {
    header("Location: form.html?erro=1");
    exit();
}
?>