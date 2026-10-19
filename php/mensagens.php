<?php
/**
 * Lista as mensagens recebidas pelo formulário de contato.
 * Uso pessoal/administrativo — não está linkada no menu do site.
 */
 
require_once 'conexao.php';
 
$stmt = $conexao->prepare(
    'SELECT id, nome, email, mensagem, enviado_em FROM mensagens_contato ORDER BY enviado_em DESC'
);
$stmt->execute();
$mensagens = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mensagens recebidas — Gustavo Begatti</title>
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
          <h2 class="secao-titulo">Mensagens <span class="marcador">recebidas</span></h2>
          <p class="secao-descricao">Lista de mensagens gravadas no banco de dados (tabela <code>mensagens_contato</code>).</p>
        </div>
 
        <?php if (count($mensagens) === 0): ?>
          <p style="color: var(--cortica);">Nenhuma mensagem recebida ainda.</p>
        <?php else: ?>
          <?php foreach ($mensagens as $msg): ?>
            <article class="cartao-papel" style="padding: 22px 26px; margin-bottom: 20px;">
              <strong><?php echo htmlspecialchars($msg['nome']); ?></strong>
              — <?php echo htmlspecialchars($msg['email']); ?>
              <p style="margin-top: 8px;"><?php echo htmlspecialchars($msg['mensagem']); ?></p>
              <small style="color: #7a7259;"><?php echo htmlspecialchars($msg['enviado_em']); ?></small>
            </article>
          <?php endforeach; ?>
        <?php endif; ?>
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
 



















