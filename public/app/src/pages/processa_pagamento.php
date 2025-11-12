<?php
session_start();
include '../../../../conexao.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: form.html");
    exit;
}

$id_usuario = $_SESSION['usuario'];
$id_servico = $_POST['id_servico'];
$valor = $_POST['valor']; // valor oculto no form
$metodo_pagamento = 'cartao';

// Cria o pedido
$sqlPedido = "INSERT INTO pedidos (id_usuario, valor_total, status) 
              VALUES ('$id_usuario', '$valor', 'pendente')";
if ($conn->query($sqlPedido) === TRUE) {
    $id_pedido = $conn->insert_id; // pega o ID do pedido criado

    // Adiciona o item do pedido
    $sqlItem = "INSERT INTO pedido_itens (id_pedido, id_servico, quantidade, preco_unitario)
                VALUES ('$id_pedido', '$id_servico', 1, '$valor')";
    $conn->query($sqlItem);

    // Registra o pagamento (simulação)
    $sqlPagamento = "INSERT INTO pagamentos (id_pedido, metodo_pagamento, status_pagamento, data_pagamento, valor)
                     VALUES ('$id_pedido', '$metodo_pagamento', 'pago', NOW(), '$valor')";
    $conn->query($sqlPagamento);

    // Atualiza o status do pedido como concluído
    $sqlUpdate = "UPDATE pedidos SET status = 'em andamento' WHERE id_pedido = '$id_pedido'";
    $conn->query($sqlUpdate);

    echo "<script>
            setTimeout(() => {
                  alert('✅ Pagamento aprovado com sucesso! Pedido #$id_servico confirmado.');
            window.location.href='../../../../index.html';
            }, 600);
          </script>";
} else {
    echo "Erro ao registrar pedido: " . $conn->error;
}

$conn->close();
?>