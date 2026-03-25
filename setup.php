<?php
require_once __DIR__ . "/config/database.php";

$pdo = Database::getConnection();

$pdo->exec("
CREATE TABLE IF NOT EXISTS clientes (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    telefone VARCHAR(20),
    endereco VARCHAR(255),
    observacoes TEXT
);

CREATE TABLE IF NOT EXISTS pets (
    id SERIAL PRIMARY KEY,
    cliente_id INT,
    nome VARCHAR(100),
    especie VARCHAR(50),
    raca VARCHAR(50),
    idade INT,
    peso VARCHAR(20),
    temperamento VARCHAR(50),
    historico_clinico TEXT
);

CREATE TABLE IF NOT EXISTS servicos (
    id SERIAL PRIMARY KEY,
    nome VARCHAR(100),
    descricao TEXT
);

CREATE TABLE IF NOT EXISTS atendimentos (
    id SERIAL PRIMARY KEY,
    pet_id INT,
    servico_id INT,
    data DATE,
    hora TIME,
    observacoes TEXT
);
");

echo "OK banco criado";