<?php
include '../conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'] ?? '';
    $descricao = $_POST['descricao'] ?? '';
    $preco = $_POST['preco'] ?? '0';
    $categoria = $_POST['categoria'] ?? '';

    // Diretório de uploads
    $diretorio = "../uploads/";
    if (!is_dir($diretorio)) {
        mkdir($diretorio, 0777, true);
    }

    // Verifica se arquivo foi enviado
    if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
        echo "Nenhuma imagem enviada ou erro no upload.";
        exit;
    }

    $arquivo = $_FILES['foto'];
    $nomeOriginal = basename($arquivo['name']);
    $tmpName = $arquivo['tmp_name'];

    // Gera nome único e seguro para salvar
    $ext = strtolower(pathinfo($nomeOriginal, PATHINFO_EXTENSION));
    $nomeSeguro = preg_replace('/[^a-zA-Z0-9_\-\.]/', '_', pathinfo($nomeOriginal, PATHINFO_FILENAME));
    $novoNome = time() . '_' . $nomeSeguro . '.' . $ext;
    $caminhoCompleto = $diretorio . $novoNome;


    $tiposPermitidos = ['jpg', 'jpeg', 'png', 'gif', 'svg'];

    if (!in_array($ext, $tiposPermitidos)) {
        echo "Formato de imagem não permitido. Use JPG, JPEG, PNG, GIF ou SVG.";
        exit;
    }

    // Validação para SVG (remove scripts)
    if ($ext === 'svg') {
        $conteudoSvg = file_get_contents($tmpName);
        if (stripos($conteudoSvg, '<script') !== false || stripos($conteudoSvg, 'onload=') !== false) {
            echo "Arquivo SVG contém código potencialmente inseguro!";
            exit;
        }
    }

    // Move o arquivo para a pasta uploads
    if (!move_uploaded_file($tmpName, $caminhoCompleto)) {
        echo "Erro ao mover arquivo enviado.";
        exit;
    }

    // Salva apenas o nome do arquivo no banco (ex: 162345_nome.svg)
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

<form method="post" enctype="multipart/form-data">
    <input type="text" name="nome" placeholder="Nome" required><br>
    <textarea name="descricao" placeholder="Descrição"></textarea><br>
    <input type="number" step="0.01" name="preco" placeholder="Preço" required><br>
    <input type="text" name="categoria" placeholder="Categoria"><br>
    <input type="file" name="foto" accept=".jpg,.jpeg,.png,.gif,.svg" required><br>
    <button type="submit">Cadastrar</button>
</form>