<?php
if (!isset($_GET['cliente_id'])) {
    die("Cliente não informado.");
}

$cliente_id = $_GET['cliente_id'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Pet</title>

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

        <h2 class="mb-4 text-center">🐾 Cadastro de Pet</h2>

        <form method="POST" action="/controladores/cadastrar_pet.php">

            <input type="hidden" name="cliente_id" value="<?= $cliente_id ?>">

            <input class="form-control mb-3" type="text" name="nome" placeholder="Nome do Pet" required>

            <input class="form-control mb-3" type="text" name="especie" placeholder="Espécie" required>

            <input class="form-control mb-3" type="text" name="raca" placeholder="Raça">

            <input class="form-control mb-3" type="number" name="idade" placeholder="Idade">

            <input class="form-control mb-3" type="text" name="peso" placeholder="Peso">

            <input class="form-control mb-3" type="text" name="temperamento" placeholder="Temperamento">

            <textarea class="form-control mb-3" name="historico_clinico" placeholder="Histórico Clínico"></textarea>

            <button class="btn btn-primary w-100" type="submit">
                Cadastrar Pet
            </button>

        </form>

    </div>

</div>

</body>
</html>