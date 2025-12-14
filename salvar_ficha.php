<?php
session_start();
require "json_db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') { 
    header("Location: login.php"); 
    exit; 
}

$db = loadDB();

$info = $_POST['info'] ?? [];
$status = $_POST['status'] ?? [];
$inventario = $_POST['inventario'] ?? [];
$mente = $_POST['mente'] ?? [];

$num = count($db['fichas']) + 1;
$codigo = 'F' . str_pad($num, 3, '0', STR_PAD_LEFT);

$ficha = [
    "id" => $num,
    "codigo" => $codigo,
    "usuario_id" => null,
    "info" => [
        "nome" => $info['nome'] ?? '',
        "efeitos" => $info['efeitos'] ?? '',
        "titulos" => $info['titulos'] ?? '',
        "dinheiro" => (int)($info['dinheiro'] ?? 0),
        "classe" => $info['classe'] ?? '',
        "hp" => (int)($info['hp'] ?? 100)
    ],
    "status" => [
        "level" => (int)($status['level'] ?? 1),
        "forca" => (int)($status['forca'] ?? 1),
        "velocidade" => (int)($status['velocidade'] ?? 1),
        "agilidade" => (int)($status['agilidade'] ?? 1),
        "experiencia" => (int)($status['experiencia'] ?? 1),
        "iq" => (int)($status['iq'] ?? 1),
        "stamina" => (int)($status['stamina'] ?? 5),
        "durabilidade" => (int)($status['durabilidade'] ?? 1),
        "combate" => (int)($status['combate'] ?? 1),
        "energia" => (int)($status['energia'] ?? 5),
        "aura" => (int)($status['aura'] ?? 1)
    ],
    "inventario" => [
        "itens" => $inventario['itens'] ?? '',
        "talento" => $inventario['talento'] ?? '',
        "poderes" => $inventario['poderes'] ?? '',
        "poderes_classe" => $inventario['poderes_classe'] ?? ''
    ],
    "mente" => [
        "sanidade_atual" => (int)($mente['sanidade_atual'] ?? 100),
        "sanidade_max" => (int)($mente['sanidade_max'] ?? 100),
        "estresse" => (int)($mente['estresse'] ?? 0),
        "traumas" => $mente['traumas'] ?? '',
        "rm" => (int)($mente['rm'] ?? 10)
    ],
    "criado_em" => date("c")
];

$db['fichas'][] = $ficha;
saveDB($db);

header("Location: ver_ficha.php?codigo=$codigo");
exit;
?>