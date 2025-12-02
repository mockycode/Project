<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/project/public/app/src/assets/styles/index.css">
</head>
<body>
    <header>
        <img class="logo" src="/project/public/app/src/src/assets/components/logo/logo-mockycode.svg" alt="">

        <nav>
            <a href="/project/">Home</a>
            <a href="/project/public/app/src/pages/pacote.php">Pacote</a>
            <a href="/project/public/app/src/pages/contato.php">Contato</a>
            <a href="/project/public/app/src/pages/sobrenos.php">Sobre nós</a>
        </nav>

        <div class="btns-menu" id="userMenuBtn">
            <img src="/project/public/app/src/src/assets/components/icons/user.png" alt="">
        </div>

        <div class="menu-dropdown" id="userDropdown">
            <?php
                $perfilLink = ($_SESSION['tipo'] === 'admin')
                    ? '/project/admin/admin.php'
                    : '/project/index.php';
            ?>
            <a href="<?php echo $perfilLink; ?>">Meu Perfil</a>
            <a href="/project/logout.php">Sair</a>
        </div>

    </header>

    <script>
    const btn = document.getElementById("userMenuBtn");
    const menu = document.getElementById("userDropdown");

    btn.addEventListener("click", () => {
        menu.style.display = menu.style.display === "flex" ? "none" : "flex";
    });

    document.addEventListener("click", (e) => {
        if (!btn.contains(e.target) && !menu.contains(e.target)) {
            menu.style.display = "none";
        }
    });
</script>

</body>
</html>