<?php

require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/classes/Atendimento.php";

$pet_id = 1;

$historicoPet = new Atendimento($pdo);
$reultado = $historicoPet->listarPorpet($pet_id);
var_dump($reultado);