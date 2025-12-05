<?php 
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/app/src/pages/form.html');
        exit();
    }
include '../conexao.php';

    $sqlUsers = "SELECT * FROM usuarios";
$resultUsers = $conn->query($sqlUsers);


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin | Listar Usuarios</title>
    <link rel="shortcut icon" href="/project/public/app/src/src/assets/components/logo/logo-mockycode.svg" type="image/x-icon">
    <link rel="stylesheet" href="../public/app/src/assets/styles/admin.css">
</head>
<body>
    <section class="admin">
        <?php include '../includes/menu-left.php'; ?>

        <div class="rigth">
            <h1>Olá, Administrador!</h1>
            <h2>Pedidos e Pagamentos</h2>

            <table>
        <thead>
            <tr>
                <th>ID usuario</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Senha</th>
                <th>Telefone</th>
                <th>Tipo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $resultUsers->fetch_assoc()) { ?>
            <tr>
                <td>#<?= $row['id_usuario'] ?></td>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['email']) ?></td>
                <td><?= htmlspecialchars($row['senha']) ?></td>
                <td><?= htmlspecialchars($row['telefone']) ?></td>
                <td><?= htmlspecialchars($row['tipo']) ?></td>
                <td>    <a href="editar_usuarios.php?id=<?= $row['id_usuario'] ?>" class="btn-action edit">Editar</a>

    <a href="deletar_usuario.php?id=<?= $row['id_usuario'] ?>" 
       class="btn-action delete"
       onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
        Excluir</td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
        </div>
    </section>
</body>
</html>