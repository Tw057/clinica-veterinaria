<?php
class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {

            $host = "dpg-d71vurh5pdvs7390p230-a.oregon-postgres.render.com";
            $db = "clinica_4hbx";
            $user = "clinica_user";
            $pass = "COLOCA_TUA_SENHA_AQUI";
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
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?><?php
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
            } catch (PDOException $e) {
                die("Erro na conexão: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>