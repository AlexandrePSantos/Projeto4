-- Drop the database if it exists
DROP DATABASE IF EXISTS GESImoveis;

-- Create the database
CREATE DATABASE GESImoveis;

-- Use the database
USE GESImoveis;

-- Create the Utilizador table
CREATE TABLE Utilizador (
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

-- Create the Imovel table
CREATE TABLE Imovel (
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
    FOREIGN KEY (id_user) REFERENCES Utilizador(id_user)
);

-- Create the Tipo_depesa table
CREATE TABLE Tipo_depesa (
    id_tipo_despesa INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Create the Despesa table
CREATE TABLE Despesa (
    id_desp INT AUTO_INCREMENT PRIMARY KEY,
    id_imovel INT,
    id_user INT,
    id_tipo_despesa INT,
    data DATE,
    valor DECIMAL(10, 2),
    FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel),
    FOREIGN KEY (id_user) REFERENCES Utilizador(id_user),
    FOREIGN KEY (id_tipo_despesa) REFERENCES Tipo_depesa(id_tipo_despesa)
);

-- Create the Inquilino table
CREATE TABLE Inquilino (
    id_inquilino INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(255),
    apelido VARCHAR(255),
    email VARCHAR(255),
    telemovel VARCHAR(20),
    telefone VARCHAR(20),
    morada VARCHAR(255)
);

-- Create the Arrendamento table
CREATE TABLE Arrendamento (
    id_arrendamento INT AUTO_INCREMENT PRIMARY KEY,
    id_inquilino INT,
    id_imovel INT,
    data_ini DATE,
    data_fim DATE,
    valor DECIMAL(10, 2),
    perocidade_pag VARCHAR(50),
    valor_pago DECIMAL(10, 2),
    FOREIGN KEY (id_inquilino) REFERENCES Inquilino(id_inquilino),
    FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel)
);

-- Create the Pagamento table
CREATE TABLE Pagamento (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    id_arrendamento INT,
    data_pag DATE,
    metodo_pag VARCHAR(255),
    FOREIGN KEY (id_arrendamento) REFERENCES Arrendamento(id_arrendamento)
);

-- Create the Tipo_contrato table
CREATE TABLE Tipo_contrato (
    id_tipo_contrato INT AUTO_INCREMENT PRIMARY KEY,
    id_user INT,
    tipo VARCHAR(255),
    FOREIGN KEY (id_user) REFERENCES Utilizador(id_user)
);

-- Create the Tipo_despesa table
CREATE TABLE Tipo_despesa (
    id_tipo_despesa INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Create the Fotos table
CREATE TABLE Fotos (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    id_imovel INT,
    foto VARCHAR(255),
    FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel)
);
