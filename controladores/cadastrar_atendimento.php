<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/Atendimento.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pdo = Database::getConnection();

    $pet_id = $_POST['pet_id'] ?? 0;
    $servico_id = $_POST['servico_id'] ?? 0;
    $data = $_POST['data'] ?? '';
    $hora = $_POST['hora'] ?? '';
    $observacoes = $_POST['observacoes'] ?? '';
    
    $atendimento = new Atendimento($pdo);
    $resultado = $atendimento->criar($pet_id, $servico_id, $data, $hora, $observacoes);
 
    
    if ($resultado['sucesso']) {
        header("Location: /historico/historico_pet.php?pet_id=" . $pet_id . "&msg=" . urlencode($resultado['mensagem']));
        exit;
    } else {
        header("Location: /formulario/form_atendimento.php?pet_id=" . $pet_id . "&erro=" . urlencode($resultado['mensagem']));
        exit;
    }
}
?>