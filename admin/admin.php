<?php 
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/app/src/pages/form.html');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../public/app/src/assets/styles/admin.css">
</head>
<body>
    <section class="admin">
        <div class="left">
            <a href="pedidos.php"><p>Pedidos</p></a>
            <a href="listar_servico.php"><p>Produtos</p></a>
        </div>

        <div class="rigth">
            <h1>Olá, Administrador!</h1>
        </div>
    </section>
</body>
</html>