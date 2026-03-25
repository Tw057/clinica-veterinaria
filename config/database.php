<?php
class Database {
    private static $pdo = null;

    public static function getConnection() {
        if (self::$pdo === null) {

            $host = "mysql.railway.internal";
            $db = "railway";
            $user = "root";
            $pass = "KNvgfiCrUkjdCSjRnIbdOvjuQdeIVrPp";
            $port = "3306";

            try {
                self::$pdo = new PDO(
                    "mysql:host=$host;port=$port;dbname=$db;charset=utf8mb4",
                    $user,
                    $pass,
                    [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                    ]
                );
            } catch (PDOException $e) {
                die("Erro: " . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>