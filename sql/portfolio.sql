-- =========================================================
-- Gustavo Begatti — Portfólio
-- Banco de dados: mensagens do formulário de contato
-- Importe este arquivo no phpMyAdmin (aba "Importar")
-- =========================================================
 
CREATE DATABASE IF NOT EXISTS portfolio_gustavo
  CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
 
USE portfolio_gustavo;
 
CREATE TABLE IF NOT EXISTS mensagens_contato (
  id         INT AUTO_INCREMENT PRIMARY KEY,
  nome       VARCHAR(100) NOT NULL,
  email      VARCHAR(150) NOT NULL,
  mensagem   TEXT NOT NULL,
  enviado_em DATETIME DEFAULT CURRENT_TIMESTAMP
);
 