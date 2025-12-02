<?php
    session_start();

    include '../conexao.php';

    if(!isset($_SESSION['tipo']) || $_SESSION['tipo'] !== 'admin'){
        header('Location: ../public/app/src/pages/form.html');
        exit();
    }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '0';
    $categoria = $_POST['categoria'] ?? '';

    $diretorio = "../uploads/";
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        echo "Nenhuma imagem enviada ou erro no upload.";
        exit;
    }

    $arquivo = $_FILES['foto'];
    $nomeOriginal = basename($arquivo['name']);
    $tmpName = $arquivo['tmp_name'];


    $ext = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    $nomeSeguro = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', pathinfo($nomeOriginal, PATHINFO_FILENAME));
    $novoNome = time() . '_' . $nomeSeguro . '.' . $ext;
    $caminhoCompleto = $diretorio . $novoNome;


    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

    if (!in_array($ext, $tiposPermitidos)) {
        echo "Formato de imagem não permitido. Use JPG, JPEG, PNG, GIF ou SVG.";
        exit;
    }

    if ($ext === 'svg') {
        $conteudoSvg = file_get_contents($tmpName);
        if (stripos($conteudoSvg, '<script') !== false || stripos($conteudoSvg, 'onload=') !== false) {
            echo "Arquivo SVG contém código potencialmente inseguro!";
            exit;
        }
    }


    if (!move_uploaded_file($tmpName, $caminhoCompleto)) {
        echo "Erro ao mover arquivo enviado.";
        exit;
    }

    
    $imagemNoBanco = $novoNome;

    $stmt = $conn->prepare("INSERT INTO servicos (nome, descricao, preco, categoria, imagem) VALUES (?, ?, ?, ?, ?)");
    if ($stmt === false) {
        echo "Erro na preparação do banco: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssdss", $nome, $descricao, $preco, $categoria, $imagemNoBanco);

    if ($stmt->execute()) {
        header("Location: listar_servico.php");
        exit;
    } else {
        echo "Erro ao cadastrar serviço: " . $stmt->error;
    }
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
    <?php include '../includes/menu-left.php'; ?>

        <div class="rigth">
            <h1>Olá, Administrador!</h1>
            <h2>Aqui você pode adicionar novos produtos...</h2>
            <form method="post" enctype="multipart/form-data">
                <input type="text" name="nome" placeholder="Nome" required><br>
                <textarea name="descricao" placeholder="Descrição"></textarea><br>
                <input type="number" step="0.01" name="preco" placeholder="Preço" required><br>
                <input type="text" name="categoria" placeholder="Categoria"><br>
                <input type="file" name="foto" accept=".jpg,.jpeg,.png,.gif,.svg" ><br>
                <button type="submit">Cadastrar</button>
            </form>
        </div>
    </section>
</body>
</html>