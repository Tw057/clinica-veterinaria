<?php
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/../classes/Atendimento.php";
require_once __DIR__ . "/../classes/pet.php";
require_once __DIR__ . "/../classes/Cliente.php";

$pdo = Database::getConnection();

$pet_id = $_GET['pet_id'] ?? null;
$cliente_id = $_GET['cliente_id'] ?? null;
$mensagem = $_GET['msg'] ?? '';
$erro = $_GET['erro'] ?? '';

$pet = new Pet($pdo);
$cliente = new Cliente($pdo);
$atendimento = new Atendimento($pdo);

// Busca todos os clientes para o select
$clientes = $cliente->listarTodos();
?>

// Busca todos os clientes para o select
$clientes = $cliente->listarTodos();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Histórico de Atendimentos</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1000px; margin: 0 auto; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); margin-bottom: 20px; }
        .mensagem { background: #4CAF50; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
        .erro { background: #f44336; color: white; padding: 10px; border-radius: 5px; margin-bottom: 20px; }
        select, input { padding: 8px; margin: 5px; border: 1px solid #ddd; border-radius: 4px; }
        button { background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #45a049; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #4CAF50; color: white; }
        tr:nth-child(even) { background: #f2f2f2; }
        .btn { background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin: 5px; }
        .btn-secondary { background: #666; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Histórico de Atendimentos</h1>

        <?php if ($mensagem): ?>
            <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
        <?php endif; ?>

        <?php if ($erro): ?>
            <div class="erro"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <!-- Card de seleção -->
        <div class="card">
            <h3>Selecionar Pet</h3>
            
            <form method="GET" action="">
                <label for="cliente_id">Cliente:</label>
                <select name="cliente_id" id="cliente_id" onchange="this.form.submit()">
                    <option value="">Selecione um cliente</option>
                    <?php foreach ($clientes as $c): ?>
                        <option value="<?= $c['id'] ?>" <?= ($cliente_id == $c['id']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($c['nome']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </form>

            <?php if ($cliente_id): 
                $pets = $pet->listarPorCliente($cliente_id);
            ?>
                <form method="GET" action="" style="margin-top: 15px;">
                    <input type="hidden" name="cliente_id" value="<?= $cliente_id ?>">
                    <label for="pet_id">Pet:</label>
                    <select name="pet_id" id="pet_id" required onchange="this.form.submit()">
                        <option value="">Selecione um pet</option>
                        <?php foreach ($pets as $p): ?>
                            <option value="<?= $p['id'] ?>" <?= ($pet_id == $p['id']) ? 'selected' : '' ?>>
                                <?= htmlspecialchars($p['nome']) ?> (<?= htmlspecialchars($p['especie']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            <?php endif; ?>
        </div>

        <?php if ($pet_id): 
            $dados_pet = $pet->buscarPorId($pet_id);
            $historico = $atendimento->listarPorPet($pet_id);
        ?>
            <!-- Card com dados do pet -->
            <div class="card">
                <h3>📋 Dados do Pet</h3>
                <p>
                    <strong>Nome:</strong> <?= htmlspecialchars($dados_pet['nome']) ?><br>
                    <strong>Cliente:</strong> <?= htmlspecialchars($dados_pet['nome_cliente']) ?><br>
                    <strong>Espécie:</strong> <?= htmlspecialchars($dados_pet['especie']) ?><br>
                    <strong>Raça:</strong> <?= htmlspecialchars($dados_pet['raca'] ?? 'Não informada') ?><br>
                    <strong>Idade:</strong> <?= $dados_pet['idade'] ?? 'Não informada' ?> anos<br>
                    <strong>Peso:</strong> <?= $dados_pet['peso'] ?? 'Não informado' ?>
                </p>
            </div>

            <!-- Card com histórico -->
            <div class="card">
                <h3>📅 Histórico de Atendimentos</h3>

                <?php if (count($historico) > 0): ?>
                    <table>
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Hora</th>
                                <th>Serviço</th>
                                <th>Observações</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($historico as $a): ?>
                            <tr>
                                <td><?= date('d/m/Y', strtotime($a['data'])) ?></td>
                                <td><?= $a['hora'] ?></td>
                                <td><?= htmlspecialchars($a['nome_servico'] ?? 'Serviço não encontrado') ?></td>
                                <td><?= htmlspecialchars($a['observacoes'] ?? '') ?></td>
                                <td>
                                    <?php 
                                    $status = $a['status'] ?? 'agendado';
                                    $cor = $status == 'realizado' ? 'green' : ($status == 'cancelado' ? 'red' : 'orange');
                                    echo "<span style='color: $cor; font-weight: bold;'>$status</span>";
                                    ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Nenhum atendimento encontrado para este pet.</p>
                <?php endif; ?>
            </div>

            <a href="/formulario/form_atendimento.php?pet_id=<?= $pet_id ?>" class="btn">➕ Novo Atendimento</a>
        <?php endif; ?>

        <br>
        <a href="/" class="btn btn-secondary">🏠 Voltar ao Início</a>
    </div>
</body>
</html>