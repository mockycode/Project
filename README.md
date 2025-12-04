# Project Mocky Code

README — MockyCode (Admin / Frontend / Pagamentos)

Última atualização: 04 Dez 2025
Autor: BRUNO BARBOSA DE JESUS DA SILVA 
Autor: IGOR IBIAPINO DOS SANTOS 

# Visão geral

Documento técnico e de referência para o conjunto de arquivos PHP/HTML/CSS/JS
 Descreve propósito geral, organização, cada arquivo importante, como rodar localmente, como preparar o banco de dados, fluxos principais (login, cadastro, CRUD de serviços, pedidos e pagamento simulado) e recomendações de segurança / melhorias.

# Sumário

# Arquitetura e organização de pastas

# Lista de arquivos e descrição (detalhada)

# Banco de dados (tabelas essenciais + SQL de exemplo)

# Como rodar localmente (pré-requisitos + passos)

# Fluxos principais do sistema

# Variáveis de ambiente / config

# Boas práticas e recomendações de segurança

# Sugestões de melhorias e roadmap curto

# Contato

Visão geral

Este projeto é um sistema simples de vendas de serviços (landing + catálogo), com painel administrativo (admin) para gerenciar serviços e pedidos. Inclui:

Front-end público (páginas de home, sobre, pacotes, contato);

Área administrativa (dashboard, listar/cadastrar/editar/excluir serviços, controle de pedidos);

Fluxo de compra com seleção de pacote, formulário de pagamento (simulado) e registro de pedido/pagamento;

Autenticação básica (login/registro) com senhas armazenadas por password_hash().

O projeto foca em disponibilizar os recursos essenciais para um e-commerce/serviços simples com PHP + MySQL.

Arquitetura e organização (observada nos arquivos enviados)

📝 1. Descrição Geral do Sistema

Este projeto consiste em uma plataforma desenvolvida em PHP + MySQL com interface HTML, CSS e Bootstrap Icons, permitindo que usuários se cadastrem, façam login, visualizem serviços, realizem pedidos e simulações de pagamento.

A aplicação conta com:

Área pública (home)

Área autenticada (usuário)

Área administrativa (admin)

Persistência de pedidos e pagamentos no banco

Sessões de login e controle de acesso

Estrutura organizada por pastas

📂 2. Estrutura Geral de Pastas e Arquivos
/
├─ index.php
├─ login.php
├─ registro.php
├─ logout.php
├─ conexao.php
├─ includes/
│   ├─ header.php
│   ├─ header-log.php
├─ admin/
│   ├─ admin.php
│   ├─ servicos/
│       ├─ deletar_servico.php
│       ├─ listar_servico.php
├─ pagamentos/
│   ├─ registrar.php
├─ public/
│   ├─ app/
│       ├─ src/
│           ├─ pages/
│           │   ├─ form.html
│           ├─ assets/
│               ├─ styles/
│               │   ├─ index.css
│               ├─ components/
│                   ├─ icons
│                   ├─ logos-clientes

🔎 3. Documentação Arquivo por Arquivo
📄 conexao.php

Função: realizar conexão segura com o banco.

Detecta ambiente (local/Fly.io)

Utiliza variáveis de ambiente

Evita reescrever código de conexão

Retorna $conn para uso global

📄 index.php

Home page principal.

Funções:

Inicia sessão

Verifica se usuário está logado

Exibe header específico (logado / visitante)

Mostra conteúdo geral do site:

Texto institucional

Botões (CTA)

Seção clientes

Seção contato

Footer com redes sociais e bandeiras

Botão flutuante do WhatsApp

📄 /includes/header.php

Usado quando visitante acessa o site.

Links públicos

Botão de login/cadastro

📄 /includes/header-log.php

Usado quando usuário logado acessa.

Mostra nome do usuário

Opção de logout

Menu com permissões de uso

📄 form.html

Tela de Login e Registro.

Características:

Forms para Login e Cadastro

Alternância entre telas via JS

Botão exibir/ocultar senha

Ícones visuais

Redirecionamento automático

📄 login.php

Responsável pela autenticação.

Processo:

Recebe email e senha via POST

Busca usuário no MySQL usando prepare()

Confere senha com password_verify()

Define variáveis da sessão:

id_usuario

nome

tipo

Redireciona:

Admin → /admin/admin.php

Usuário → /index.php

📄 registro.php

Executa o processo de cadastro.

Processo:

Recebe dados do form

Criptografa senha (password_hash)

Insere no banco

Redireciona para área admin

📄 logout.php

Encerra sessão do usuário.

Processo:

session_start()

session_destroy()

Redireciona → tela de login

📄 admin/admin.php

Página administrativa.

Permissões:

Apenas tipo = admin pode acessar

Funções gerais:

Visualização e gerenciamento de serviços

📄 admin/servicos/deletar_servico.php

Exclusão de serviço.

Processo:

Confere se é admin

Recebe ID via GET

Executa DELETE na tabela

Redireciona para listagem

📄 pagamentos/registrar.php

Simula processo real de pagamento.

Processo:

Recebe dados do serviço

Insere pedido

Insere item do pedido

Grava pagamento

Atualiza status do pedido

Retorna confirmação para o usuário

🛢 4. Banco de Dados (Visão Geral)

As tabelas principais são:

usuarios

servicos

pedidos

pedido_itens

pagamentos

Relacionamentos:

Usuário possui pedidos

Pedido contém vários itens

Pagamento vinculado ao pedido

🔐 5. Segurança Aplicada
Medida	Descrição
password_hash()	Senha criptografada no banco
password_verify()	Autenticação segura
Sessions	Evita acesso sem login
Prepared Statements	Previne SQL Injection
📱 6. Responsividade

Mobile First

Uso de CSS responsivo

Ícones visuais acessíveis

🧩 7. Lógica do Sistema (Resumo por Fluxo)
Fluxo Login:
form → login.php → valida → cria sessão → redireciona

Fluxo Registro:
form → registro.php → criptografa → insere no banco

Fluxo Usuário Autenticado:
acessa páginas → rota verifica sessão → manipula DB

Fluxo Pagamento:
serviço → registrar.php → cria pedido → salva item → salva pagamento → status atualizado

Fluxo Admin:
admin → listar_servicos → deletar_servico → atualiza DB

🧭 8. Navegação do Usuário
Nível	Acesso
Visitante	Home, login, cadastro
Usuário	Home logada, serviços, pagamento
Admin	Gestão de usuários e serviços
🚀 9. Melhorias Futuras

Carrinho de compras

Checkout real (API externa)

Painel admin avançado

Histórico de pedidos

Integração Pix e PagSeguro