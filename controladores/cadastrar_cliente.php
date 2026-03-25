<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/Cliente.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pdo = Database::getConnection();
    $cliente = new Cliente($pdo);
    
    $nome = $_POST["nome"] ?? '';
    $telefone = $_POST["telefone"] ?? '';
    $endereco = $_POST["endereco"] ?? '';
    $observacoes = $_POST["observacoes"] ?? '';
    
    $idCliente = $cliente->cadastrar($nome, $telefone, $endereco, $observacoes);
    
    if ($idCliente) {
        header("Location: /formulario/form_pet.php?cliente_id=" . $idCliente);
        exit;
    } else {
        header("Location: /formulario/form_cliente.php?erro=1");
        exit;
    }
}
?>