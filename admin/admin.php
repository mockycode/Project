<?php 
    session_start();

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/src/pages/form.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="pedidos.php">pedidos</a>
    <a href="listar_servico.php">produtos</a>
</body>
</html>