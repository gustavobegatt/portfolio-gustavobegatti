<?php
/**
 * Conexão com o banco de dados (PDO)
 * ------------------------------------------------------------
 * Ajuste $usuario e $senha se o seu MySQL/XAMPP usar login
 * diferente do padrão (root, sem senha).
 */
 
$host    = 'localhost';
$dbname  = 'portfolio_gustavo';
$usuario = 'root';
$senha   = '';
 
try {
    $conexao = new PDO(
        "mysql:host={$host};dbname={$dbname};charset=utf8mb4",
        $usuario,
        $senha
    );
 
    // Faz o PDO lançar exceções em caso de erro (em vez de falhar silenciosamente)
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    die('Erro de conexão com o banco de dados: ' . $erro->getMessage());
}
 