<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Menu</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/menu.css">
  </head>
  <body>
    <?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.html");
}

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");
$query = "SELECT nome, funcao FROM usuario where cod=".$_SESSION['id'];
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);

echo "<header>";
echo "<div id='navegacao'><div class='linksDiv'><a href='dados.php' class='links'>Visualizar dados sensores</a></div>";
if($row[1]=="administrador"){
  echo "<div class='linksDiv'><a href='usuarios_view.php' class='links'>Gerenciar usuários</a></div>";
}
echo "<div class='linksDiv'><a href='editar_dados_pessoais.php' class='links'>Alterar meus dados</a></div>";
//echo "[<a href='mqtt.php'>MQTT</a>]";
echo "<div class='linksDiv'><a href='alertas.php' class='links'>Alertas</a></div></div>";

//echo "<div class='linksDiv'><a href='mqtt.php' class='links'>MQTT</a></div></div>";

echo "<div class='cantoDireito'><p id='logado'>Logado com: ".$row[0].",</p></div><br>";
echo "<div class='cantoDireito'><a href='logout.php' id='sair' class='links'>Sair</a></div>";
//echo "[<a href='form_inserir.php'>Inserir Filme</a>]";
//echo "[<a href='logout.php'>Sair</a>]";
echo "</header>";

/*
$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "SELECT * FROM alerta WHERE visualizado='nao'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
$rows = mysqli_num_rows($result);
if(isset($row[0])){
  echo "<div class='pendencia'>Há $rows alertas pendentes!</div>";
}
*/

include("mqtt.php");
 ?>
</body>
</html>
