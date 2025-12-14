<?php
session_start();
require "json_db.php";
$db = loadDB();

$error = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario']);
    $senha = $_POST['senha'];
    $found = null;
    foreach($db['usuarios'] as $u) {
        if ($u['usuario'] === $usuario) { $found = $u; break; }
    }
    if ($found && isset($found['senha']) && password_verify($senha, $found['senha'])) {
        $_SESSION['user_id'] = $found['id'];
        $_SESSION['usuario'] = $found['usuario'];
        $_SESSION['tipo'] = $found['tipo'];
        header("Location: painel.php"); exit;
    } else $error = "Credenciais inválidas.";
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>

<?php if($error) echo "<p style='color:red;'>".htmlspecialchars($error)."</p>"; ?>
<form method="post">
    <div>
        <h1>Login</h1>
        <input name="usuario" placeholder="Usuário" required><br><br>
        <input name="senha" placeholder="Senha" type="password" required><br><br>
        
        <button type="submit">Entrar</button>
    </div>
</form>
</body>
</html>
