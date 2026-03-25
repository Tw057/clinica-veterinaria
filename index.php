<?php
require_once __DIR__ . "/config/database.php";
require_once __DIR__ . "/classes/Atendimento.php";

$pdo = Database::getConnection();
$atendimento = new Atendimento($pdo);

$ultimos = $atendimento->listarPorPeriodo(
    date('Y-m-d', strtotime('-30 days')),
    date('Y-m-d')
);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Veterinária</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(135deg, #d4fc79, #96e6a1);
        }

        .navbar {
            background-color: #2c3e50;
        }

        .card {
            border-radius: 15px;
            border: none;
        }

        .btn:hover {
            transform: scale(1.05);
            transition: 0.2s;
        }
    </style>
</head>

<body>

<!-- HEADER -->
<nav class="navbar navbar-dark">
    <div class="container">
        <span class="navbar-brand">🐾 Patinhas & Cia</span>
    </div>
</nav>

<!-- CONTEÚDO -->
<div class="container mt-5 text-center">

    <h1 class="mb-3">Clínica Veterinária</h1>
    <p class="text-muted mb-4">Sistema de gestão de atendimentos</p>

    <div class="mb-4">
        <a href="formulario/form_cliente.php" class="btn btn-success m-2">
            📋 Cadastrar Cliente
        </a>

        <a href="historico/historico_pet.php" class="btn btn-primary m-2">
            📊 Ver Histórico
        </a>
    </div>

    <div class="card shadow p-4">
        <h4 class="mb-3">📅 Últimos Atendimentos</h4>

        <?php if (count($ultimos) > 0): ?>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Cliente</th>
                        <th>Pet</th>
                        <th>Serviço</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($ultimos as $a): ?>
                        <tr>
                            <td><?= date('d/m/Y', strtotime($a['data'])) ?></td>
                            <td><?= $a['nome_cliente'] ?></td>
                            <td><?= $a['nome_pet'] ?></td>
                            <td><?= $a['nome_servico'] ?></td>
                            <td><?= $a['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="text-muted">Nenhum atendimento nos últimos 30 dias.</p>
        <?php endif; ?>
    </div>

</div>

</body>
</html>