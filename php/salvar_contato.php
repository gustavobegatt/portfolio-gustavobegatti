<?php
/**
 * Recebe os dados do formulário de contato e grava no banco.
 * Só aceita requisições POST vindas de pages/contato.html.
 */
 
require_once 'conexao.php';
 
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/contato.html');
    exit;
}
 
// Dados enviados pelo formulário
$nome     = trim($_POST['nome'] ?? '');
$email    = trim($_POST['email'] ?? '');
$mensagem = trim($_POST['mensagem'] ?? '');
 
// Validação no servidor (nunca confiar só na validação do JavaScript)
$erros = [];
 
if (mb_strlen($nome) < 2) {
    $erros[] = 'Digite seu nome completo.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $erros[] = 'Digite um e-mail válido.';
}
if (mb_strlen($mensagem) < 10) {
    $erros[] = 'A mensagem precisa ter pelo menos 10 caracteres.';
}
 
$sucesso = false;
 
if (empty($erros)) {
    // Prepared statement: os "?" evitam SQL Injection, o dado do usuário
    // nunca é concatenado diretamente na consulta SQL.
    $stmt = $conexao->prepare(
        'INSERT INTO mensagens_contato (nome, email, mensagem) VALUES (?, ?, ?)'
    );
    $stmt->execute([$nome, $email, $mensagem]);
    $sucesso = true;
    $stmt->execute([$nome, $email, $mensagem]);

// --- DEBUG TEMPORÁRIO ---
$totalAgora = $conexao->query('SELECT COUNT(*) FROM mensagens_contato')->fetchColumn();
$bancoAtual = $conexao->query('SELECT DATABASE()')->fetchColumn();
error_log("DEBUG: banco={$bancoAtual} total_registros={$totalAgora}");
// --- FIM DEBUG ---

$sucesso = true;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contato — Gustavo Begatti</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="fundo-corticha">
 
  <header class="cabecalho">
    <div class="container">
      <a href="../index.html" class="marca">
        <span class="pino" aria-hidden="true"></span>
        Gustavo <span class="assinatura">Begatti</span>
      </a>
      <nav class="nav-principal" aria-label="Navegação principal">
        <ul>
          <li><a href="../index.html">Sobre</a></li>
          <li><a href="../pages/projetos.html">Projetos</a></li>
          <li><a href="../pages/contato.html">Contato</a></li>
        </ul>
      </nav>
    </div>
  </header>
 
  <main>
    <section class="secao">
      <div class="container">
        <div class="secao-cabecalho">
          <h2 class="secao-titulo">
            <?php echo $sucesso ? 'Mensagem <span class="marcador">enviada!</span>' : 'Algo <span class="marcador">deu errado</span>'; ?>
          </h2>
        </div>
 
        <div class="contato-caixa cartao-papel">
          <span class="fita" aria-hidden="true"></span>
          <span class="pino-vermelho" aria-hidden="true"></span>
 
          <?php if ($sucesso): ?>
            <p class="form-feedback feedback-sucesso">
              Obrigado, <?php echo htmlspecialchars($nome); ?>! Sua mensagem foi recebida e gravada com sucesso.
            </p>
          <?php else: ?>
            <p class="form-feedback feedback-erro">Corrija os itens abaixo e envie novamente:</p>
            <ul>
              <?php foreach ($erros as $erro): ?>
                <li class="erro-campo"><?php echo htmlspecialchars($erro); ?></li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
 
          <a class="botao-secundario" href="../pages/contato.html">← Voltar ao formulário</a>
        </div>
      </div>
    </section>
  </main>
 
  <footer class="rodape">
    <div class="container">
      <span class="rodape-marca">Gustavo Begatti</span>
      <p class="rodape-copy">Feito por Gustavo Begatti · © 2026</p>
    </div>
  </footer>
 
</body>
</html>
 