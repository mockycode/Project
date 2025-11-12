<?php
    include '../../../../conexao.php';

    $result = $conn->query("SELECT * FROM servicos WHERE ativo = 1");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="../assets/styles/pacote.css">
    <title>Pagina Pacote</title>
</head>

<body>
    <header>
        <img class="logo" src="../src/assets/components/logo/logo-mockycode.svg" alt="">

        <nav>
            <a href="../../../../index.html">Home</a>
            <a href="../pages/pacote.html">Pacote</a>
            <a href="../pages/contato.html">Contato</a>
            <a href="./sobrenos.html">Sobre nós</a>
        </nav>

        <div class="btns-menu">
            <button class="btn-login">Login</button>
            <button class="btn-singup">sign up</button>
        </div>
    </header>

    <section>
        <div class="content-mockcode">
            <div class="content">
                <h2>"Transformamos sua ideia em presença digital."</h2>
                <p>Sua forma de pagar agora é muito mais simples, com a experiência em rapidez, segurança confiança e
                    agilidade.</p>
            </div>

            <div class="content-img">
                <img src="../src/assets/components/icons/mulher.svg" alt="">
            </div>

        </div>
    </section>

    <section>
        <div class="content-card">

            <?php while ($row = $result->fetch_assoc()): ?>
        <div class="card">


            <?php if (!empty($row['imagem'])): ?>
                <img src="../../../../uploads/<?php echo htmlspecialchars($row['imagem']); ?>" 
                    alt="<?php echo htmlspecialchars($row['nome']); ?>" 
                    width="250" height="180">
            <?php else: ?>
                <img src="https://via.placeholder.com/250x180?text=Serviço" alt="Serviço">
            <?php endif; ?>

            <div class="card-text">
            <h3><?php echo htmlspecialchars($row['nome']); ?></h3>
            <p><img src="../src/assets/components/icons/check.svg" alt=""><?php echo nl2br(htmlspecialchars($row['descricao'])); ?></p>
            <button>
                <a class="btn" href="pagamento.php?id=<?php echo $row['id_servico']; ?>">
                R$ <?php echo number_format($row['preco'], 2, ',', '.'); ?>
                <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                </a>
            </button>
            </div>
        </div>
    <?php endwhile; ?>


            <div class="card">
                <img src="../src/assets/components/icons/gestao-insta.svg">

                <div class="card-text">
                    <h3>Gestão de Redes Sociais</h3>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Gestão das redes sociais:
                        movimentação, postagens e engajamento nos posts</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Criação de conteúdo estratégico</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Análise de métricas e relatórios
                        mensais</p>
                    <button><a href="./pagamento.html">
                            R$799,99
                            <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                        </a></button>
                </div>
            </div>

            <div class="card">
                <img src="../src/assets/components/icons/gestao-insta.svg">

                <div class="card-text">
                    <h3>Gestão de Redes Sociais</h3>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Gestão das redes sociais:
                        movimentação, postagens e engajamento nos posts</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Criação de conteúdo estratégico</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Análise de métricas e relatórios
                        mensais</p>
                    <button><a href="">
                            R$799,99
                            <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                        </a></button>
                </div>
            </div>

            <div class="card">
                <img src="../src/assets/components/icons/gestao-insta.svg">

                <div class="card-text">
                    <h3>Gestão de Redes Sociais</h3>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Gestão das redes sociais:
                        movimentação, postagens e engajamento nos posts</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Criação de conteúdo estratégico</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Análise de métricas e relatórios
                        mensais</p>
                    <button><a href="">
                            R$799,99
                            <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                        </a></button>
                </div>
            </div>

            <div class="card">
                <img src="../src/assets/components/icons/gestao-insta.svg">

                <div class="card-text">
                    <h3>Gestão de Redes Sociais</h3>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Gestão das redes sociais:
                        movimentação, postagens e engajamento nos posts</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Criação de conteúdo estratégico</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Análise de métricas e relatórios
                        mensais</p>
                    <button><a href="">
                            R$799,99
                            <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                        </a></button>
                </div>
            </div>

            <div class="card">
                <img src="../src/assets/components/icons/gestao-insta.svg">

                <div class="card-text">
                    <h3>Gestão de Redes Sociais</h3>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Gestão das redes sociais:
                        movimentação, postagens e engajamento nos posts</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Criação de conteúdo estratégico</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Análise de métricas e relatórios
                        mensais</p>
                    <button><a href="">
                            R$799,99
                            <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                        </a></button>
                </div>
            </div>

            <div class="card">
                <img src="../src/assets/components/icons/gestao-insta.svg">

                <div class="card-text">
                    <h3>Gestão de Redes Sociais</h3>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Gestão das redes sociais:
                        movimentação, postagens e engajamento nos posts</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Criação de conteúdo estratégico</p>
                    <p><img src="../src/assets/components/icons/check.svg" alt=""> Análise de métricas e relatórios
                        mensais</p>
                    <button><a href="">
                            R$799,99
                            <img src="../../src/src/assets/components/icons/carrinho.svg" alt="">
                        </a></button>
                </div>
            </div>

    </section>

    <div class="content-button">
        <button>Crie seu Pacote</button>
    </div>

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

    <section>
        <div class="cultura-empresa">
            <img src="../src/assets/components/icons/cultura.svg" alt="">
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
</body>