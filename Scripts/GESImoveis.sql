-- Drop the database if it exists
DROP DATABASE IF EXISTS GESImoveis;

-- Create the database
CREATE DATABASE GESImoveis;

-- Use the database
USE GESImoveis;

-- Criar tabela Tipo_depesa
CREATE TABLE tipo_depesa (
    id_tipo_despesa INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Criar tabela Tipo_contrato
CREATE TABLE tipo_contrato (
    id_tipo_contrato INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Criar tabela Utilizador
CREATE TABLE users (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    is_admin BOOLEAN,
    nome VARCHAR(255),
    apelido VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    telemovel VARCHAR(20),
    telefone VARCHAR(20),
    titulo VARCHAR(255),
    localidade VARCHAR(255),
    cod_postal VARCHAR(10),
    cidade VARCHAR(255),
    distrito VARCHAR(255),
    pais VARCHAR(255)
);

-- Criar tabela tipo_imovel
CREATE TABLE tipo_imovel (
    id_tipo_imovel INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Criar tabela Imovel
CREATE TABLE imovel (
    id_imovel INT AUTO_INCREMENT PRIMARY KEY,
    id_tipo_imovel INT,
    id_user INT,
    area DECIMAL(10, 2),
    morada VARCHAR(255),
    andar VARCHAR(50),
    num_divisoes INT,
    ano_construcao INT,
    val_seguro DECIMAL(10, 2),
    val_imi DECIMAL(10, 2),
    val_condominio DECIMAL(10, 2),
    data_aquisicao DATE,
    preco_compra DECIMAL(10, 2),
    FOREIGN KEY (id_tipo_imovel) REFERENCES tipo_imovel(id_tipo_imovel),
    FOREIGN KEY (id_user) REFERENCES users(id_user)
);

-- Criar tabela Despesa
CREATE TABLE despesa (
    id_desp INT AUTO_INCREMENT PRIMARY KEY,
    id_imovel INT,
    id_user INT,
    id_tipo_despesa INT,
    data DATE,
    valor DECIMAL(10, 2),
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
    FOREIGN KEY (id_user) REFERENCES users(id_user),
    FOREIGN KEY (id_tipo_despesa) REFERENCES tipo_depesa(id_tipo_despesa)
);

-- Criar tabela Inquilino
CREATE TABLE inquilino (
    id_inquilino INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    apelido VARCHAR(255),
    email VARCHAR(255),
    telemovel VARCHAR(20),
    telefone VARCHAR(20),
    morada VARCHAR(255)
);

-- Criar tabela Contrato
CREATE TABLE contrato (
    id_contrato INT AUTO_INCREMENT PRIMARY KEY,
    id_inquilino INT,
    id_imovel INT,
    id_tipo_contrato INT,
    data_ini DATE,
    data_fim DATE,
    valor DECIMAL(10, 2),
    perocidade_pag VARCHAR(50),
    estado VARCHAR(50),
    data_termino DATE,
    valor_pago DECIMAL(10, 2),
    FOREIGN KEY (id_inquilino) REFERENCES inquilino(id_inquilino),
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
    FOREIGN KEY (id_tipo_contrato) REFERENCES tipo_contrato(id_tipo_contrato)
);

-- Criar tabela Pagamento
CREATE TABLE pagamento (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    id_contrato INT,
    data_pag DATE,
    metodo_pag VARCHAR(255),
    valor DECIMAL(10, 2),
    FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato)
);

-- Criar tabela Fotos
CREATE TABLE fotos (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    id_imovel INT,
    foto VARCHAR(255),
    FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel)
);

-- Restrições de integridade para a tabela Imovel
ALTER TABLE imovel
ADD CONSTRAINT fk_tipo_imovel FOREIGN KEY (id_tipo_imovel) REFERENCES tipo_imovel(id_tipo_imovel),
ADD CONSTRAINT fk_user_imovel FOREIGN KEY (id_user) REFERENCES users(id_user);

-- Restrições de integridade para a tabela Despesa
ALTER TABLE despesa
ADD CONSTRAINT fk_imovel_despesa FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
ADD CONSTRAINT fk_user_despesa FOREIGN KEY (id_user) REFERENCES users(id_user),
ADD CONSTRAINT fk_tipo_despesa FOREIGN KEY (id_tipo_despesa) REFERENCES tipo_depesa(id_tipo_despesa);

-- Restrições de integridade para a tabela Contrato
ALTER TABLE contrato
ADD CONSTRAINT fk_inquilino_contrato FOREIGN KEY (id_inquilino) REFERENCES inquilino(id_inquilino),
ADD CONSTRAINT fk_imovel_contrato FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
ADD CONSTRAINT fk_tipo_contrato_contrato FOREIGN KEY (id_tipo_contrato) REFERENCES tipo_contrato(id_tipo_contrato);

-- Restrições de integridade para a tabela Pagamento
ALTER TABLE pagamento
ADD CONSTRAINT fk_contrato_pagamento FOREIGN KEY (id_contrato) REFERENCES contrato(id_contrato);

-- Restrições de integridade para a tabela Fotos
ALTER TABLE fotos
ADD CONSTRAINT fk_imovel_fotos FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel);

-- Inserir dados na tabela Tipo_depesa
INSERT INTO tipo_depesa (tipo) VALUES
('Água'),
('Eletricidade'),
('Gás'),
('Internet'),
('Manutenção');

-- Inserir dados na tabela Tipo_contrato
INSERT INTO tipo_contrato (tipo) VALUES
('Arrendamento'),
('Compra e Venda'),
('Usufruto');

-- Inserir dados na tabela Utilizador
INSERT INTO users (is_admin, nome, apelido, email, password, telemovel, telefone, titulo, localidade, cod_postal, cidade, distrito, pais) VALUES
(1, 'Admin', 'Admin', 'admin@example.com', 'admin123', '912345678', '223456789', 'Sr.', 'Porto', '4000-001', 'Porto', 'Porto', 'Portugal'),
(0, 'João', 'Silva', 'joao@example.com', 'joao123', '912345678', '223456789', 'Dr.', 'Lisboa', '1000-001', 'Lisboa', 'Lisboa', 'Portugal');

-- Inserir dados na tabela tipo_imovel
INSERT INTO tipo_imovel (tipo) VALUES
('Apartamento'),
('Moradia'),
('Escritório'),
('Loja'),
('Armazém');

-- Inserir dados na tabela Imovel
INSERT INTO imovel (id_tipo_imovel, id_user, area, morada, andar, num_divisoes, ano_construcao, val_seguro, val_imi, val_condominio, data_aquisicao, preco_compra) VALUES
(1, 2, 100.00, 'Rua A', '1º', 3, 2000, 150.00, 200.00, 50.00, '2022-01-01', 200000.00),
(2, 1, 200.00, 'Rua B', NULL, 5, 1990, 200.00, 250.00, 0.00, '2021-01-01', 300000.00);

-- Inserir dados na tabela Despesa
INSERT INTO despesa (id_imovel, id_user, id_tipo_despesa, data, valor) VALUES
(1, 2, 1, '2024-01-15', 50.00),
(1, 2, 2, '2024-01-20', 60.00),
(2, 1, 1, '2024-01-10', 70.00),
(2, 1, 2, '2024-01-25', 80.00);

-- Inserir dados na tabela Inquilino
INSERT INTO inquilino (nome, apelido, email, telemovel, telefone, morada) VALUES
('Maria', 'Santos', 'maria@example.com', '912345678', '223456789', 'Rua C'),
('Carlos', 'Ferreira', 'carlos@example.com', '912345678', '223456789', 'Rua D');

-- Inserir dados na tabela Contrato
INSERT INTO contrato (id_inquilino, id_imovel, id_tipo_contrato, data_ini, data_fim, valor, perocidade_pag, estado, data_termino, valor_pago) VALUES
(1, 1, 1, '2024-01-01', '2024-12-31', 1000.00, 'Mensal', 'Ativo', NULL, 800.00),
(2, 2, 1, '2024-01-01', '2024-12-31', 1500.00, 'Mensal', 'Ativo', NULL, 1200.00);

-- Inserir dados na tabela Pagamento
INSERT INTO pagamento (id_contrato, data_pag, metodo_pag, valor) VALUES
(1, '2024-01-05', 'Transferência Bancária', 800.00),
(2, '2024-01-10', 'Dinheiro', 1200.00);

-- Inserir dados na tabela Fotos
INSERT INTO fotos (id_imovel, foto) VALUES
(1, 'foto1.jpg'),
(1, 'foto2.jpg'),
(2, 'foto3.jpg');
