<?php
session_start();
require "json_db.php";

if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$db = loadDB();
$error = "";
$ok = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $usuario = trim($_POST["usuario"]);
    $senha = $_POST["senha"];
    $tipo = $_POST["tipo"];

    foreach ($db['usuarios'] as $u) {
        if ($u['usuario'] === $usuario) {
            $error = "Usuário já existe.";
            break;
        }
    }

    if (!$error) {
        $id = count($db['usuarios']) + 1;

        $db['usuarios'][] = [
            "id" => $id,
            "usuario" => $usuario,
            "senha" => password_hash($senha, PASSWORD_DEFAULT),
            "tipo" => $tipo
        ];

        saveDB($db);
        $ok = "Usuário criado.";
    }
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Criar Usuário</title>
    <link rel="stylesheet" href="style.css">

</head>
<body>
    
        <h2>Criar Usuário</h2>
        
        <?php if ($error): ?>
            <p style="color:red;"><?=$error?></p>
    <?php endif; ?>

    <?php if ($ok): ?>
    <p style="color:green;"><?=$ok?></p>
    <?php endif; ?>

    <form method="post">
    <label>Usuário</label><br>
    <input name="usuario" required><br><br>

    <label>Senha</label><br>
    <input name="senha" type="password" required><br><br>

    <label>Tipo</label><br>
    <select name="tipo">
        <option value="player">player</option>
        <option value="admin">admin</option>
    </select><br><br>

    <button type="submit">Criar</button>
    </form>

    <br><a href="painel.php">Voltar</a>
    
</body>
</html>
