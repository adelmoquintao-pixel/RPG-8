<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['tipo'] !== 'admin') { 
    header("Location: login.php");
    exit;
}
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Criar Ficha</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Criar Ficha</h2>

<form action="salvar_ficha.php" method="post">

  <label>Nome</label><br>
  <input name="info[nome]" required><br>

  <label>Efeitos</label><br>
  <textarea name="info[efeitos]"></textarea><br>

  <label>Títulos</label><br>
  <textarea name="info[titulos]"></textarea><br>

  <label>Dinheiro</label><br>
  <input name="info[dinheiro]" type="number" value="0"><br>

  <label>Classe</label><br>
  <input name="info[classe]"><br>

  <label>HP</label><br>
  <input name="info[hp]" type="number" value="100"><br>
<hr>
  <h3>Status</h3>
  Level <input name="status[level]" type="number" value="1"><br>
  Força <input name="status[forca]" type="number" value="1"><br>
  Velocidade <input name="status[velocidade]" type="number" value="1"><br>
  Agilidade <input name="status[agilidade]" type="number" value="1"> <br>
  Experiência <input name="status[experiencia]" type="number" value="1"> <br>
  IQ <input name="status[iq]" type="number" value="100"> <br>
  Stamina <input name="status[stamina]" type="number" value="5"> <br>
  Durabilidade <input name="status[durabilidade]" type="number" value="1"> <br>
  Combate <input name="status[combate]" type="number" value="1"> <br>
  Energia <input name="status[energia]" type="number" value="5"> <br>
  Aura <input name="status[aura]" type="number" value="1"> <br>
<hr>
  <h3>Inventário</h3>
  <label>Itens: </label><br><textarea name="inventario[itens]" style="width:300px; height:200px;"></textarea><br><br>
  <label>Talento:</label><br><textarea name="inventario[talento]" style="width:300px; height:100px;"></textarea><br><br>
  <label>Poderes:</label><br><textarea name="inventario[poderes]" style="width:400px; height:100px;"></textarea><br><br>
  <label>Poderes da Classe: </label><br><textarea name="inventario[poderes_classe]" style="width:350px; height:100px;"></textarea><br><br>
<hr>
  <h3>Mente</h3>
  <label>Sanidade Atual: </label>
  <input name="mente[sanidade_atual]" type="number" value="100"><br>
  <label>Sanidade Máx:</label>
  <input name="mente[sanidade_max]" type="number" value="100"><br>
  <label>Estresse: </label>
  <input name="mente[estresse]" type="number" value="0"><br>
  <label>Traumas: </label><br>
  <textarea name="mente[traumas]" style="width:50px; height:50px;"></textarea><br>
  <label>Resiliencia Mental: </label>
  <input name="mente[rm]" type="number" value="10"><br>

  <br><button type="submit">Salvar ficha</button>
</form>

</body>
</html>
