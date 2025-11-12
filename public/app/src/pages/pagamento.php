<?php
include '../../../../conexao.php';
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: form.html");
    exit;
}

if (!isset($_GET['id'])) {
    echo "Serviço não encontrado!";
    exit;
}

$id = intval($_GET['id']);
$sql = "SELECT * FROM servicos WHERE id_servico = $id AND ativo = 1";
$result = $conn->query($sql);
$servico = $result->fetch_assoc();

if (!$servico) {
    echo "Serviço não encontrado!";
    exit;
}

$total = 0;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/styles/pagamento.css">
    <script src="../js/cartao.js" defer></script>
    <title>Pagamento</title>
    <style>
        #content-pagamento {
  scroll-margin-top: 100px;
  transition: box-shadow 0.3s;
}
#content-pagamento:target {
  box-shadow: 0 0 10px rgba(0,0,0,0.2);
}
    </style>
</head>

<body>
    <header>
        <img class="logo" src="../src/assets/components/logo/logo-mockycode.svg" alt="">

        <nav>
            <a href="/index.html">Home</a>
            <a href="./public/app/src/pages/pacote.html">Pacote</a>
            <a href="/public/app/src/pages/contato.html">Contato</a>
            <a href="#">Sobre nós</a>
        </nav>

        <div class="btns-menu">
            <button class="btn-login">Login</button>
            <button class="btn-singup">sign up</button>
        </div>
    </header>

    <section>
        <div class="content-quemsomos">

            <div class="quemsomos-container">

                <div class="text-quemsomos">
                    <h3>Mais rapidez e segurança em cada paramento</h3>
                    <p>Sua forma de pagar agora é muito mais simples, com a experiência em rapidez, segurança confiança
                        e agilidade.
                    </p>
                    <button>Comprar agora</button>
                </div>
                <div class="quem-somos">
                    <img src="../src/assets/components/icons/Robo-img-pagamento.svg" alt="">
                </div>
            </div>
        </div>

    </section>
    <section>

        <div class="content-card">
            <div class="card">
                <img src="../../../../uploads/<?php echo htmlspecialchars($servico['imagem']); ?>" alt="<?php echo htmlspecialchars($servico['nome']); ?>">

                <div class="card-text">
                    <h3><?php echo htmlspecialchars($servico['nome']); ?></h3>
                    <label for="">1 Item <span>R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></span></label>
                    <label for="">Cupom <span>-</span></label>
                    <label for="">Total <span>R$ <?php echo number_format($servico['preco'], 2, ',', '.'); ?></span></label>

                    <button class="btn-comprar" id="btnScrollPagamento">Adquirir pacote</button>

                    <div class="desconto">
                        <p>cupom de desconto</p>
                        <img src="../src/assets/components/icons/lixeira.svg" alt="lixeira">
                    </div>
                </div>
            </div>

            <div class="descricao">
                <h2><?php echo htmlspecialchars($servico['nome']); ?></h2>
                <img src="../src/assets/components/icons/linha-roxa.svg" alt="">
                <p><img src="../src/assets/components/icons/check.svg" alt=""><?php echo nl2br(htmlspecialchars($servico['descricao'])); ?></p>
                <p><img src="../src/assets/components/icons/check.svg" alt="">Movimentação, postagens</p>
                <p><img src="../src/assets/components/icons/check.svg" alt="">engajamento nos posts</p>
                <p><img src="../src/assets/components/icons/check.svg" alt="">Criação dos materiais para às redes sociais</p>
                <p><img src="../src/assets/components/icons/check.svg" alt="">Identidade Visual</p>
                <p><img src="../src/assets/components/icons/check.svg" alt="">Tipografia, Formas etc.</p>
                <p><img src="../src/assets/components/icons/check.svg" alt="">Logotipo</p>
      
                <h3>Garanta já à oportunidade de alavancar o seu négocio!</h3>
            </div>
        </div>
    </section>

    <section>
        <div class="content-pagamento" id="content-pagamento">
            <div class="bloco">
                <div class="pagamento">
                    <div class="sifrao-img">
                        <h2>Adicione um novo cartão</h2>
                        <img src="../src/assets/components/icons/robo-sifrão.svg" alt="">
                    </div>
                </div>
                <div class="container">
                    <section class="card dual-color" id="card">
                        <div class="front">
                            <div class="brand-logo" id="brand-logo">
                            </div>
                            <img src="https://raw.githubusercontent.com/falconmasters/formulario-tarjeta-credito-3d/master/img/chip-tarjeta.png"
                                class="chip">
                            <div class="details">
                                <div class="group" id="number">
                                    <p class="label">Numero</p>
                                    <p class="number">#### #### #### ####</p>
                                </div>
                                <div class="flexbox">
                                    <div class="group" id="name">
                                        <p class="label"> Nome </p>
                                        <p class="name">#### #### ####</p>
                                    </div>
                                    <div class="group" id="expiration">
                                        <p class="label">Validade</p>
                                        <p class="expiration"> <span class="month">MM</span> / <span
                                                class="year">AA</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="back">
                            <div class="magnetic-bar"></div>
                            <div class="details">
                                <div class="group" id="signature">
                                    <p class="label">Assinatura</p>
                                    <div class="signature">
                                        <p></p>
                                    </div>
                                </div>
                                <div class="group" id="ccv">
                                    <p class="label">CCV</p>
                                    <p class="ccv"></p>
                                </div>
                            </div>
                            <p class="legend">Pode chamar ele de roxinho. Além disso,
                                pode chamar também de moderno, gratuito e prático.</p>
                            <a href="#" class="bank-link">www.nubank.com</a>
                        </div>
                    </section>
                    <div class="container-btn">
                        <button class="btn-open-form" id="btn-open-form">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                    <form action="processa_pagamento.php" id="card-form" class="card-form" method="POST">

                    <input type="hidden" name="id_servico" value="<?php echo $servico['id_servico']; ?>">
    <input type="hidden" name="valor" value="<?php echo $servico['preco']; ?>">
                        <div class="group">
                            <label for="inputNumber">Número</label>
                            <input type="text" id="inputNumber" maxlength="19" autocomplete="off">
                        </div>
                        <div class="group">
                            <label for="inputHolder">Nome</label>
                            <input type="text" id="inputHolder" maxlength="19" autocomplete="off">
                        </div>
                        <div class="flexbox">
                            <div class="group expire">
                                <label for="selectMonth">Validade</label>
                                <div class="flexbox">
                                    <div class="group-select">
                                        <select name="month" id="selectMonth">
                                            <option disabled selected> Mês </option>
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                    <div class="group-select">
                                        <select name="year" id="selectYear">
                                            <option disabled selected> Ano </option>
                                        </select>
                                        <i class="fas fa-angle-down"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="group ccv">
                                <label for="inputCCV">CVV</label>
                                <input type="text" id="inputCCV" maxlength="3">
                            </div>
                        </div>
                        <button type="submit" class="btn-submit" id="confirmarPagamento"> Enviar </button>
                    </form>
                    
    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $id_servico = $_POST['id_servico'] ?? null;
        $nome_cartao = $_POST['nome_cartao'];
        $numero_cartao = $_POST['numero_cartao'];
    }
    ?>
    <script>
  const inputNumero = document.getElementById('numero_cartao');
  const inputValidade = document.getElementById('validade');

  // Formata número do cartão: 0000 0000 0000 0000
  inputNumero.addEventListener('input', (e) => {
    e.target.value = e.target.value
      .replace(/\D/g, '')
      .replace(/(\d{4})(?=\d)/g, '$1 ')
      .trim();
  });

  // Formata validade: MM/AA
  inputValidade.addEventListener('input', (e) => {
    e.target.value = e.target.value
      .replace(/\D/g, '')
      .replace(/(\d{2})(\d)/, '$1/$2')
      .substr(0, 5);
  });
</script>
                    <script src="https://kit.fontawesome.com/2c36e9b7b1.js" crossorigin="anonymous"></script>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="content-email">

            <div class="content-input">

                <div class="img-email">
                    <img src="../src/assets/components/icons/icon-email.svg" alt="">
                </div>

                <div class="newsleter">
                    <h2>entre em contato!</h2>

                    <div class="input-group">
                        <input type="email" name="email" id="email" placeholder="Digite seu email">
                        <i class="bi bi-envelope-at"></i>
                        <button type="submit">Enviar</button>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="content-footer">

            <div class="footer">

                <img src="../src/assets/components/logo/logo-mockycode.svg" alt="">

                <div class="group-redes">
                    <a href=""><img src="../src/assets/components/icons/intagram.svg" alt=""></a>
                    <a href=""><img src="../src/assets/components/icons/Twitter.svg" alt=""></a>
                    <a href=""><img src="../src/assets/components/icons/Discord.svg" alt=""></a>
                    <a href=""><img src="../src/assets/components/icons/Github.svg" alt=""></a>
                </div>
            </div>

            <div class="footer-bandeiras">
                <div class="group-links">
                    <h4>Inicio</h4>
                    <a href="">Home</a>
                    <a href="">Pacotes</a>
                    <a href="">sobre Nós</a>
                    <a href="">Redes sociais</a>
                </div>

                <div class="group-links">
                    <h4>Inicio</h4>
                    <a href="">Home</a>
                    <a href="">Pacotes</a>
                    <a href="">sobre Nós</a>
                    <a href="">Redes sociais</a>
                </div>

                <div class="group-links">
                    <h4>Inicio</h4>
                    <a href="">Home</a>
                    <a href="">Pacotes</a>
                    <a href="">sobre Nós</a>
                    <a href="">Redes sociais</a>
                </div>

                <div class="bandeiras">
                    <h2>Bandeiras</h2>
                    <div class="grid-img">
                        <img src="../src/assets/components/icons/elo.svg" alt="">
                        <img src="../src/assets/components/icons/Visa.svg" alt="">
                        <img src="../src/assets/components/icons/pix.svg" alt="">
                        <img src="../src/assets/components/icons/Mastercard.svg" alt="">
                        <img src="../src/assets/components/icons/google-app.svg" alt="">
                        <img src="../src/assets/components/icons/aplle-app.svg" alt="">

                        <img src="../../src/assets/components/icons/Visa.svg" alt="">
                        <img src="../../src/assets/components/icons/pix.svg" alt="">
                        <img src="../../src/assets/components/icons/Mastercard.svg" alt="">
                        <img src="../../src/assets/components/icons/google-app.svg" alt="">
                        <img src="../../src/assets/components/icons/aplle-app.svg" alt="">
                    </div>
                </div>
            </div>
            <div class="divisoria">
                <img src="../src/assets/components/icons/linha.svg" alt="">
            </div>
            <div class="copy">
                <p>Direitos mockycode &copy; 2025</p>
            </div>
        </div>
    </footer>

    <!-- Botão WhatsApp -->
    <a href="https://wa.me/5599999999999" class="btn-whats" target="_blank">
        <i class="bi bi-whatsapp"></i>
    </a>
<script>
  document.getElementById("btnScrollPagamento").addEventListener("click", function() {
    const secaoPagamento = document.getElementById("content-pagamento");
    secaoPagamento.scrollIntoView({ behavior: "smooth" });
  });
</script>
</body>

</html>