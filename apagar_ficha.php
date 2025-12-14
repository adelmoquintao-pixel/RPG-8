<?php
session_start();
require "json_db.php";

if (!isset($_SESSION['user_id'])) { exit("Acesso negado."); }
if ($_SESSION['tipo'] !== 'admin') { exit("Apenas admin pode apagar."); }
if (!isset($_GET['codigo'])) { exit("Código faltando."); }

$codigo = $_GET['codigo'];
$db = loadDB();

foreach ($db['fichas'] as $i => $ficha) {
    if ($ficha['codigo'] === $codigo) {
        unset($db['fichas'][$i]);
        $db['fichas'] = array_values($db['fichas']);
        saveDB($db);
        header("Location: fichas.php");
        exit;
    }
}

exit("Ficha não encontrada.");
