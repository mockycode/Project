// Função de transição para troca de tela login

const telaLogin = document.querySelector('#login-registro');
const btnLogin = document.querySelector('#btn-login');
const btnRegistro = document.querySelector('#btn-registro');

btnRegistro.addEventListener('click', () => {
    telaLogin.classList.add('ativo')
})

btnLogin.addEventListener('click', () => {
    telaLogin.classList.remove('ativo')
})

// --------------------------------------------------------

// // Função de Esconder e ver Senha!

const botoes = document.querySelectorAll(".btn-senha");

botoes.forEach((btn) => {
  btn.addEventListener("click", function () {
    const input = this.previousElementSibling; // pega o input logo antes do ícone
    if (input.type === "password") {
      input.type = "text";
      this.classList.replace("bi-eye", "bi-eye-slash");
    } else {
      input.type = "password";
      this.classList.replace("bi-eye-slash", "bi-eye");
    }
  });
});

