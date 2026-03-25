<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Cliente</title>

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

        <h2 class="mb-4 text-center">📋 Cadastro de Cliente</h2>

        <form method="POST" action="../controladores/cadastrar_cliente.php">

            <input class="form-control mb-3" type="text" name="nome" placeholder="Nome" required>

            <input class="form-control mb-3" type="text" name="telefone" placeholder="Telefone">

            <input class="form-control mb-3" type="text" name="endereco" placeholder="Endereço">

            <textarea class="form-control mb-3" name="observacoes" placeholder="Observações"></textarea>

            <button class="btn btn-success w-100" type="submit">
                Cadastrar
            </button>

        </form>

    </div>

</div>

</body>
</html>