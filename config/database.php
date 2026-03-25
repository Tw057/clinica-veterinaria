<?php
class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {

            $host = "dpg-d71vurh5pdvs7390p230-a.oregon-postgres.render.com";
            $db = "clinica_4hbx";
            $user = "clinica_user";
            $pass = "EpoECRClHLPv2eQjXuhIMFt6xx0hNrt6";
            $port = "5432";

            try {
                self::$pdo = new PDO(
                    "pgsql:host=$host;port=$port;dbname=$db",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );

                // 🔥 CRIA AS TABELAS AUTOMATICAMENTE
                self::$pdo->exec("
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

            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>