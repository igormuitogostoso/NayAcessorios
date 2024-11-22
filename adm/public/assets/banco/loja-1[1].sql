CREATE DATABASE IF NOT EXISTS `loja` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `loja`;

-- Tabela de Clientes
CREATE TABLE IF NOT EXISTS `cliente` (
  `cliente_cod` INT NOT NULL AUTO_INCREMENT,  
  `cliente_cep` INT NOT NULL,
  `cliente_cpf` VARCHAR(11) NOT NULL,
  `cliente_nome` VARCHAR(255) NOT NULL,
  `cliente_telefone` VARCHAR(15) NOT NULL,  
  `cliente_email` VARCHAR(255) NOT NULL UNIQUE,  
  `cliente_senha` VARCHAR(255) NOT NULL,  
  `cliente_endereco` VARCHAR(255) NOT NULL,
  `data_nascimento` DATE NOT NULL,  
  `imagem_cliente` VARCHAR(255) NOT NULL,
  `recuperar_senha_token` VARCHAR(255) DEFAULT NULL,  
  `recuperar_senha_expiracao` DATETIME DEFAULT NULL, 
  PRIMARY KEY (`cliente_cod`),
  UNIQUE KEY `cliente_email_UNIQUE` (`cliente_email`)  
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela login (corrigida)
CREATE TABLE IF NOT EXISTS `login` (
  `id_login` INT AUTO_INCREMENT PRIMARY KEY,
  `cliente_email` VARCHAR(255) NOT NULL,
  `cliente_senha` VARCHAR(255) NOT NULL,
  `tipo_usuario` ENUM('usuario', 'administrador') NOT NULL DEFAULT 'usuario',
  CONSTRAINT `fk_login_email` FOREIGN KEY (`cliente_email`) 
    REFERENCES `cliente` (`cliente_email`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Produtos
CREATE TABLE IF NOT EXISTS `produto` (
  `cod_prod` INT NOT NULL AUTO_INCREMENT,            
  `prod_preco` DECIMAL(10, 2) NOT NULL,               
  `prod_quanti` INT NOT NULL,                         
  `prod_desc` VARCHAR(255) NOT NULL,                  
  `prod_nome` VARCHAR(255) NOT NULL,                  
  `imagem_produto` VARCHAR(255) NOT NULL,             
  `tamanho_prod` VARCHAR(255) NOT NULL,              
  `categoria_prod` VARCHAR(255) NOT NULL,             
  `avaliacao_media` DECIMAL(2,1) DEFAULT 0.0,         
  PRIMARY KEY (`cod_prod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Avaliações
CREATE TABLE IF NOT EXISTS `avaliacoes` (
    `cod_ava` INT AUTO_INCREMENT PRIMARY KEY,
    `cod_prod` INT NOT NULL,        
    `cod_cliente` INT NOT NULL,     
    `avaliacao` DECIMAL(2,1) NOT NULL,  
    FOREIGN KEY (`cod_prod`) REFERENCES `produto`(`cod_prod`)
      ON DELETE CASCADE 
      ON UPDATE CASCADE,
    FOREIGN KEY (`cod_cliente`) REFERENCES `cliente`(`cliente_cod`)
      ON DELETE CASCADE 
      ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Carrinho
CREATE TABLE IF NOT EXISTS `carrinho` (
  `cod_carrinho` INT NOT NULL AUTO_INCREMENT,
  `categoria_prod` VARCHAR(20) NOT NULL,
  `nome_prod` VARCHAR(50) NOT NULL,
  `preco_total` DECIMAL(10,2) NOT NULL,
  `cliente_cod` INT NOT NULL,
  `cod_prod` INT NOT NULL,
  PRIMARY KEY (`cod_carrinho`),
  CONSTRAINT `carrinho_ibfk_1` FOREIGN KEY (`cod_prod`) REFERENCES `produto` (`cod_prod`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `carrinho_ibfk_2` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cliente_cod`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Compra
CREATE TABLE IF NOT EXISTS `compra` (
  `cod_compra` INT NOT NULL AUTO_INCREMENT,
  `status_compra` VARCHAR(50) NOT NULL,
  `preco_total` DECIMAL(10,2) NOT NULL,
  `cod_carrinho` INT NOT NULL,
  `cliente_cod` INT NOT NULL,
  `cod_prod` INT NOT NULL,
  `forma_pagamento` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`cod_compra`),
  CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`cod_prod`) REFERENCES `produto` (`cod_prod`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `compra_ibfk_2` FOREIGN KEY (`cod_carrinho`) REFERENCES `carrinho` (`cod_carrinho`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `compra_ibfk_3` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cliente_cod`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Favoritos
CREATE TABLE IF NOT EXISTS `favoritos` (
  `codigo_fav` INT NOT NULL AUTO_INCREMENT,
  `imagem_prod` VARCHAR(255) NOT NULL,
  `nome_prod` VARCHAR(25) NOT NULL,
  `categoria_prod` VARCHAR(255) NOT NULL,
  `cod_prod` INT NOT NULL,
  PRIMARY KEY (`codigo_fav`),
  CONSTRAINT `favoritos_ibfk_1` FOREIGN KEY (`cod_prod`) REFERENCES `produto` (`cod_prod`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Finanças
CREATE TABLE IF NOT EXISTS `financas` (
  `cod_financas` INT NOT NULL AUTO_INCREMENT,
  `cod_compra` INT NOT NULL,
  `despesas_fixas` DECIMAL(10,2) NOT NULL,
  `lucro_fina` DECIMAL(10,2) NOT NULL,
  `saldo_fina` DECIMAL(10,2) NOT NULL,
  PRIMARY KEY (`cod_financas`),
  CONSTRAINT `financas_ibfk_1` FOREIGN KEY (`cod_compra`) REFERENCES `compra` (`cod_compra`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Tabela de Meus Pedidos
CREATE TABLE IF NOT EXISTS `meus_pedidos` (
  `cod_meus_pedidos` INT NOT NULL AUTO_INCREMENT,
  `preco_prod` DECIMAL(10,2) NOT NULL,
  `nome_prod` VARCHAR(50) NOT NULL,
  `categoria_prod` VARCHAR(20) NOT NULL,
  `cliente_cod` INT NOT NULL,
  `cod_compra` INT NOT NULL,
  PRIMARY KEY (`cod_meus_pedidos`),
  CONSTRAINT `meus_pedidos_ibfk_1` FOREIGN KEY (`cod_compra`) REFERENCES `compra` (`cod_compra`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE,
  CONSTRAINT `meus_pedidos_ibfk_2` FOREIGN KEY (`cliente_cod`) REFERENCES `cliente` (`cliente_cod`) 
    ON DELETE CASCADE 
    ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
