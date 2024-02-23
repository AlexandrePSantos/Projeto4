-- Drop the database if it exists
DROP DATABASE IF EXISTS GESImoveis;

-- Create the database
CREATE DATABASE GESImoveis;

-- Use the database
USE GESImoveis;

-- Criar tabela Utilizador
CREATE TABLE utilizador (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    apelido VARCHAR(255),
    email VARCHAR(255),
    telemovel VARCHAR(20),
    telefone VARCHAR(20),
    titulo VARCHAR(255),
    localidade VARCHAR(255),
    cod_postal VARCHAR(10),
    cidade VARCHAR(255),
    distrito VARCHAR(255),
    pais VARCHAR(255)
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
    FOREIGN KEY (id_user) REFERENCES utilizador(id_user)
);

-- Criar tabela Tipo_depesa
CREATE TABLE tipo_depesa (
    id_tipo_despesa INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
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
    FOREIGN KEY (id_user) REFERENCES utilizador(id_user),
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

-- Criar tabela Tipo_contrato
CREATE TABLE tipo_contrato (
    id_tipo_contrato INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
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
ADD CONSTRAINT fk_user_imovel FOREIGN KEY (id_user) REFERENCES utilizador(id_user);

-- Restrições de integridade para a tabela Despesa
ALTER TABLE despesa
ADD CONSTRAINT fk_imovel_despesa FOREIGN KEY (id_imovel) REFERENCES imovel(id_imovel),
ADD CONSTRAINT fk_user_despesa FOREIGN KEY (id_user) REFERENCES utilizador(id_user),
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
