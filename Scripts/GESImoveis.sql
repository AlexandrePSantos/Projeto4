-- Drop the database if it exists
DROP DATABASE IF EXISTS GESImoveis;

-- Create the database
CREATE DATABASE GESImoveis;

-- Use the database
USE GESImoveis;

-- Create the Tipo_despesa table
CREATE TABLE Tipo_despesa (
    id_tipo_despesa INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Create the tipo_imovel table
CREATE TABLE tipo_imovel (
    id_tipo_imovel INT AUTO_INCREMENT PRIMARY KEY,
    tipo VARCHAR(255)
);

-- Create the Utilizador table
CREATE TABLE Utilizador (
    id_user INT AUTO_INCREMENT PRIMARY KEY,
    is_admin BOOLEAN,
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
    FOREIGN KEY (id_tipo_despesa) REFERENCES Tipo_despesa(id_tipo_despesa)
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

-- Create the Fotos table
CREATE TABLE Fotos (
    id_foto INT AUTO_INCREMENT PRIMARY KEY,
    id_imovel INT,
    foto VARCHAR(255),
    FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel)
);

-- CONSTRAINTS  
-- Add constraints to the Utilizador table
ALTER TABLE Utilizador
MODIFY COLUMN is_admin BOOLEAN NOT NULL;

-- Add constraints to the Imovel table
ALTER TABLE Imovel
ADD CONSTRAINT fk_tipo_imovel FOREIGN KEY (id_tipo_imovel) REFERENCES tipo_imovel(id_tipo_imovel) ON DELETE CASCADE,
ADD CONSTRAINT fk_user_imovel FOREIGN KEY (id_user) REFERENCES Utilizador(id_user) ON DELETE CASCADE;

-- Add constraints to the Despesa table
ALTER TABLE Despesa
ADD CONSTRAINT fk_imovel_despesa FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel) ON DELETE CASCADE,
ADD CONSTRAINT fk_user_despesa FOREIGN KEY (id_user) REFERENCES Utilizador(id_user) ON DELETE CASCADE,
ADD CONSTRAINT fk_tipo_despesa FOREIGN KEY (id_tipo_despesa) REFERENCES Tipo_despesa(id_tipo_despesa) ON DELETE CASCADE;

-- Add constraints to the Arrendamento table
ALTER TABLE Arrendamento
ADD CONSTRAINT fk_inquilino_arrendamento FOREIGN KEY (id_inquilino) REFERENCES Inquilino(id_inquilino) ON DELETE CASCADE,
ADD CONSTRAINT fk_imovel_arrendamento FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel) ON DELETE CASCADE;

-- Add constraints to the Pagamento table
ALTER TABLE Pagamento
ADD CONSTRAINT fk_arrendamento_pagamento FOREIGN KEY (id_arrendamento) REFERENCES Arrendamento(id_arrendamento) ON DELETE CASCADE;

-- Add constraints to the Tipo_contrato table
ALTER TABLE Tipo_contrato
ADD CONSTRAINT fk_user_tipo_contrato FOREIGN KEY (id_user) REFERENCES Utilizador(id_user) ON DELETE CASCADE;

-- Add constraints to the Fotos table
ALTER TABLE Fotos
ADD CONSTRAINT fk_imovel_fotos FOREIGN KEY (id_imovel) REFERENCES Imovel(id_imovel) ON DELETE CASCADE;

-- Add constraints to the tipo_imovel table
-- If you want to ensure that the 'tipo' column is unique
ALTER TABLE tipo_imovel
ADD CONSTRAINT unique_tipo_imovel UNIQUE (tipo);

-- TEST DATA
-- Insert data into Tipo_despesa table
INSERT INTO Tipo_despesa (tipo) VALUES ('Água'), ('Eletricidade'), ('Gás'), ('Condomínio');

-- Insert data into tipo_imovel table
INSERT INTO tipo_imovel (tipo) VALUES ('Apartamento'), ('Moradia'), ('Escritório'), ('Loja');

-- Insert data into Utilizador table
INSERT INTO Utilizador (is_admin, nome, apelido, email, telemovel, telefone, titulo, localidade, cod_postal, cidade, distrito, pais) 
VALUES (1, 'Admin', 'Admin', 'admin@example.com', '123456789', '987654321', 'Sr.', 'Lisboa', '1000-001', 'Lisboa', 'Lisboa', 'Portugal');

-- Insert data into Imovel table
INSERT INTO Imovel (id_tipo_imovel, id_user, area, morada, andar, num_divisoes, ano_construcao, val_seguro, val_imi, val_condominio, data_aquisicao, preco_compra) 
VALUES (1, 1, 100, 'Rua da Amizade, 123', '1', 3, 2000, 500, 200, 50, '2023-01-01', 200000);

-- Insert data into Inquilino table
INSERT INTO Inquilino (nome, apelido, email, telemovel, telefone, morada) 
VALUES ('João', 'Silva', 'joao@example.com', '987654321', '123456789', 'Rua do Inquilinato, 456');

-- Insert data into Arrendamento table
INSERT INTO Arrendamento (id_inquilino, id_imovel, data_ini, data_fim, valor, perocidade_pag, valor_pago) 
VALUES (1, 1, '2023-01-01', '2023-12-31', 800, 'Mensal', 800);

-- Insert data into Pagamento table
INSERT INTO Pagamento (id_arrendamento, data_pag, metodo_pag) 
VALUES (1, '2023-01-05', 'Transferência Bancária');

-- Insert data into Tipo_contrato table
INSERT INTO Tipo_contrato (id_user, tipo) 
VALUES (1, 'Contrato de Arrendamento');

-- Insert data into Fotos table
INSERT INTO Fotos (id_imovel, foto) 
VALUES (1, 'apartment1.jpg'), (1, 'apartment2.jpg');