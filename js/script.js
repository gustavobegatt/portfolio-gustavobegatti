/* =========================================================
   Gustavo Begatti — Portfólio
   script.js — interatividade do site
   ========================================================= */

/* ---------------------------------------------------------
   1. Menu de navegação mobile (abre/fecha)
   --------------------------------------------------------- */
const menuToggle = document.querySelector('#menuToggle');
const navPrincipal = document.querySelector('#navPrincipal');

if (menuToggle && navPrincipal) {
  menuToggle.addEventListener('click', function () {
    const aberto = navPrincipal.classList.toggle('aberto');
    menuToggle.setAttribute('aria-expanded', aberto);
  });

  // Fecha o menu ao clicar em algum link (útil no celular)
  navPrincipal.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      navPrincipal.classList.remove('aberto');
      menuToggle.setAttribute('aria-expanded', 'false');
    });
  });
}

/* ---------------------------------------------------------
   2. Validação do formulário de contato
   Página: pages/contato.html
   --------------------------------------------------------- */
const formContato = document.querySelector('#formContato');

if (formContato) {
  const campoNome = document.querySelector('#nome');
  const campoEmail = document.querySelector('#email');
  const campoMensagem = document.querySelector('#mensagem');
  const feedback = document.querySelector('#formFeedback');

  // Marca um campo como inválido e escreve a mensagem de erro
  function marcarInvalido(campo, erroEl, mensagem) {
    campo.classList.add('campo-invalido');
    erroEl.textContent = mensagem;
  }

  // Remove a marcação de erro de um campo
  function marcarValido(campo, erroEl) {
    campo.classList.remove('campo-invalido');
    erroEl.textContent = '';
  }

  formContato.addEventListener('submit', function (evento) {
    evento.preventDefault(); // impede o envio/recarregamento da página
    let formularioValido = true;

    // --- Nome: pelo menos 2 caracteres ---
    const erroNome = document.querySelector('#erro-nome');
    if (campoNome.value.trim().length < 2) {
      marcarInvalido(campoNome, erroNome, 'Digite seu nome completo.');
      formularioValido = false;
    } else {
      marcarValido(campoNome, erroNome);
    }

    // --- E-mail: precisa ter o formato nome@dominio.com ---
    const erroEmail = document.querySelector('#erro-email');
    const emailValido = /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(campoEmail.value.trim());
    if (!emailValido) {
      marcarInvalido(campoEmail, erroEmail, 'Digite um e-mail válido.');
      formularioValido = false;
    } else {
      marcarValido(campoEmail, erroEmail);
    }

    // --- Mensagem: pelo menos 10 caracteres ---
    const erroMensagem = document.querySelector('#erro-mensagem');
    if (campoMensagem.value.trim().length < 10) {
      marcarInvalido(campoMensagem, erroMensagem, 'Escreva uma mensagem com pelo menos 10 caracteres.');
      formularioValido = false;
    } else {
      marcarValido(campoMensagem, erroMensagem);
    }

    // --- Resultado final ---
    if (formularioValido) {
      feedback.textContent = 'Tudo certo! Sua mensagem foi validada com sucesso.';
      feedback.classList.remove('feedback-erro');
      feedback.classList.add('feedback-sucesso');
      formContato.reset();
    } else {
      feedback.textContent = 'Verifique os campos destacados antes de enviar.';
      feedback.classList.remove('feedback-sucesso');
      feedback.classList.add('feedback-erro');
    }
  });

  // Enquanto o usuário digita, some com o erro daquele campo (feedback mais rápido)
  [
    [campoNome, 'erro-nome'],
    [campoEmail, 'erro-email'],
    [campoMensagem, 'erro-mensagem']
  ].forEach(function ([campo, idErro]) {
    campo.addEventListener('input', function () {
      if (campo.classList.contains('campo-invalido') && campo.value.trim().length > 0) {
        marcarValido(campo, document.querySelector('#' + idErro));
      }
    });
  });
}