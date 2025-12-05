<?php
session_start();

if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
    header('Location: ../public/app/src/pages/form.html');
    exit();
}

include '../conexao.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID do usuário não informado.");
}

$sql = "SELECT * FROM usuarios WHERE id_usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();

if (!$usuario) {
    die("Usuário não encontrado.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    $sqlUpdate = "UPDATE usuarios SET nome=?, email=?, telefone=?, senha=? WHERE id_usuario=?";
    $stmtUpdate = $conn->prepare($sqlUpdate);
    $stmtUpdate->bind_param("ssssi", $nome, $email, $telefone, $senha, $id);

    if ($stmtUpdate->execute()) {
        header("Location: usuario.php");
        exit();
    } else {
        echo "Erro ao atualizar!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Editar Usuário</title>
    <link rel="shortcut icon" href="/project/public/app/src/src/assets/components/logo/logo-mockycode.svg" type="image/x-icon">
    c
</head>
<body>
    <section class="admin">
        <?php include '../includes/menu-left.php'; ?>

        <div class="rigth">
            <h1>Olá, Administrador!</h1>
<div class="form-card">
<form method="POST">
    <label>Nome:</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($usuario['nome']) ?>" required><br>

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required><br>

    <label>Telefone:</label>
    <input type="text" name="telefone" value="<?= htmlspecialchars($usuario['telefone']) ?>"><br>

    <label>Senha:</label>
    <input type="password" name="senha" value="<?= htmlspecialchars($usuario['senha']) ?>"><br>

    <button class="btn-submit" type="submit">Salvar</button>
</form>
</div>
        </div>
    </section>
</body>
</html>