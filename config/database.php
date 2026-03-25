<?php
class Database {
    private static $pdo = null;
    
    public static function getConnection() {
        if (self::$pdo === null) {
            $host = "localhost";
            $db = "clinica_veterinaria";
            $user = "root";
            $pass = "cr75bolasdeouro@123";
            $charset = "utf8mb4";
            
            try {
                self::$pdo = new PDO(
                    "mysql:host=$host;dbname=$db;charset=$charset",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro na conexão com o banco: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>