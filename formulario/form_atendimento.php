<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/servico.php";

$pdo = Database::getConnection();

if (!isset($_GET['pet_id'])) {
    die("Pet não informado.");
}

$pet_id = $_GET['pet_id'];

$servico = new Servico($pdo);
$servicos = $servico->listarAtivos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agendar Atendimento</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fa;
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <div class="card shadow p-4">

        <h2 class="mb-4 text-center">📅 Agendar Atendimento</h2>

        <form method="POST" action="/controladores/cadastrar_atendimento.php">

            <input type="hidden" name="pet_id" value="<?= $pet_id ?>">

            <label class="form-label">Serviço</label>
            <select class="form-select mb-3" name="servico_id" required>
                <?php foreach ($servicos as $s): ?>
                    <option value="<?= $s['id'] ?>">
                        <?= $s['nome'] ?> - <?= $s['descricao'] ?>
                    </option>
                <?php endforeach; ?>
            </select>

            <label class="form-label">Data</label>
            <input class="form-control mb-3" type="date" name="data" required>

            <label class="form-label">Hora</label>
            <input class="form-control mb-3" type="time" name="hora" required>

            <label class="form-label">Observações</label>
            <textarea class="form-control mb-3" name="observacoes" placeholder="Observações"></textarea>

            <button class="btn btn-success w-100" type="submit">
                Agendar Atendimento
            </button>

        </form>

    </div>

</div>

</body>
</html>