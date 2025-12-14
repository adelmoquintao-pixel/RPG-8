<?php
session_start();

if (!isset($_SESSION['user_id'])) { 
    header("Location: login.php"); 
    exit; 
}

$usuario = $_SESSION['usuario'];
$tipo = $_SESSION['tipo'];
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Painel</title>
    <link rel="stylesheet" href="login.css">

</head>
<body>
<?php if ($tipo === 'admin'): ?>
    <div>
   <h2>Painel — <?=htmlspecialchars($usuario)?></h2>
    <p>Tipo: <?=htmlspecialchars($tipo)?></p>
    <a class="a" href="criar_usuario.php">Criar usuário</a><br><br><br>
    <a class="a" href="criar_ficha.php">Criar ficha </a><br><br><br>
    <a class="a" href="listar_fichas.php">Listar todas as fichas</a><br><br><br>
    <br><a class="a" href="logout.php">Sair</a>
    </div>
<?php else: ?>
    <div>
    <a class="f" href="listar_fichas.php">Ver minha ficha</a><br>
    </div>
<?php endif; ?>
</body>
</html>
