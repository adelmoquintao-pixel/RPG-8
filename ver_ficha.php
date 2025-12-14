<?php
session_start();
require "json_db.php";

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$codigo = $_GET['codigo'] ?? '';
$db = loadDB();

$found = null;
foreach($db['fichas'] as $f) { 
    if ($f['codigo'] === $codigo) { 
        $found = $f; 
        break; 
    } 
}

if (!$found) { 
    echo "Ficha não encontrada."; 
    exit; 
}

$f = $found;
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Ficha <?=$f['codigo']?></title>
<style>
body{font-family:Arial;padding:18px;background:#f5f5f5}
.box{background:white;padding:12px;border-radius:6px;margin-bottom:12px}
.table td{padding:6px;border-bottom:1px solid #eee}
.btn {padding:8px 12px;border-radius:4px;text-decoration:none;color:white}
.edit {background:#0077cc;}
.delete {background:#cc0000;}
</style>
</head>
<body>

<div class="box">
  <h2><?=htmlspecialchars($f['info']['nome'])?> 
  <small>[<?=htmlspecialchars($f['codigo'])?>]</small></h2>

  <a class="btn edit" href="editar_ficha.php?codigo=<?=$f['codigo']?>">Editar</a>

  <?php if ($_SESSION['tipo'] === 'admin'): ?>
    <a class="btn delete" 
       href="apagar_ficha.php?codigo=<?=$f['codigo']?>" 
       onclick="return confirm('Tem certeza que quer apagar esta ficha?');">
       Apagar
    </a>
  <?php endif; ?>
</div>

<div class="box">
  <h3>Informações</h3>
  <table class="table">
    <tr><td>Nome</td><td><?=htmlspecialchars($f['info']['nome'])?></td></tr>
    <tr><td>Classe</td><td><?=htmlspecialchars($f['info']['classe'])?></td></tr>
    <tr><td>Efeitos</td><td><?=nl2br(htmlspecialchars($f['info']['efeitos']))?></td></tr>
    <tr><td>Títulos</td><td><?=nl2br(htmlspecialchars($f['info']['titulos']))?></td></tr>
    <tr><td>Dinheiro</td><td><?=htmlspecialchars($f['info']['dinheiro'])?></td></tr>
    <tr><td>HP</td><td><?=htmlspecialchars($f['info']['hp'])?></td></tr>
  </table>
</div>

<div class="box">
  <h3>Status</h3>
  <table class="table">
<?php foreach($f['status'] as $k=>$v): ?>
    <tr><td><?=htmlspecialchars(ucfirst(str_replace('_',' ',$k)))?></td><td><?=htmlspecialchars($v)?></td></tr>
<?php endforeach; ?>
  </table>
</div>

<div class="box">
  <h3>Inventário</h3>
  <div><?=nl2br(htmlspecialchars($f['inventario']['itens']))?></div>
  <div><b>Talento:</b> <?=nl2br(htmlspecialchars($f['inventario']['talento']))?></div>
  <div><b>Poderes:</b> <?=nl2br(htmlspecialchars($f['inventario']['poderes']) )?></div>
  <div><b>Poderes da Classe:</b> <?=nl2br(htmlspecialchars($f['inventario']['poderes_classe']))?></div>
</div>

<div class="box">
  <h3>Mente</h3>
  <table class="table">
    <tr><td>Sanidade</td><td><?=htmlspecialchars($f['mente']['sanidade_atual'])?> / <?=htmlspecialchars($f['mente']['sanidade_max'])?></td></tr>
    <tr><td>Estresse</td><td><?=htmlspecialchars($f['mente']['estresse'])?></td></tr>
    <tr><td>Traumas</td><td><?=nl2br(htmlspecialchars($f['mente']['traumas']))?></td></tr>
    <tr><td>RM</td><td><?=htmlspecialchars($f['mente']['rm'])?></td></tr>
  </table>
</div>

<p><a href="listar_fichas.php">Voltar</a></p>

</body>
</html>
