<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/pet.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = Database::getConnection();
    $pet = new Pet($pdo);
    
    $cliente_id = $_POST['cliente_id'] ?? 0;
    $nome = $_POST['nome'] ?? '';
    $especie = $_POST['especie'] ?? '';
    $raca = $_POST['raca'] ?? '';
    $idade = $_POST['idade'] ?? null;
    $peso = $_POST['peso'] ?? '';
    $temperamento = $_POST['temperamento'] ?? '';
    $historico_clinico = $_POST['historico_clinico'] ?? '';
    
    $idPet = $pet->cadastrar(
        $cliente_id, $nome, $especie, $raca, $idade, 
        $peso, $temperamento, $historico_clinico
    );
    
    if ($idPet) {
        header("Location: /formulario/form_atendimento.php?pet_id=" . $idPet);
        exit;
    } else {
        header("Location: /formulario/form_pet.php?cliente_id=" . $cliente_id . "&erro=1");
        exit;
    }
}
?>