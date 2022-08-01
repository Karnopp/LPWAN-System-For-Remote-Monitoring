<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Gerenciar Usuários</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/menu.css">
  </head>
  <body>
<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("location: login.html");
}
$cod=$_SESSION['id'];
$link = mysqli_connect("localhost", "root", "", "sistemaTCC");
$query = "SELECT funcao from usuario WHERE cod='$cod'";
$result = mysqli_query($link, $query);
$row = mysqli_fetch_row($result);
if($row[0]!="administrador"){
  header("location: menu.php");
}
//echo "<center>Logado com: ".$_SESSION['id']."</center>";
//echo "<hr>";
echo "<header>";
echo "<div id='navegacao'>";
echo "<div class='linksDiv'><a class='links' href='usuarios_view.php'>Visualizar usuários</a></div>";
echo "<div class='linksDiv'><a class='links' href='form_usuarios_include.php'>Incluir novo usuário</a></div>";
echo "<div class='linksDiv'><a class='links' href='editar_usuarios.php'>Editar usuários</a></div>";
echo "<div class='linksDiv'><a class='links' href='excluir_usuarios.php'>Deletar usuário</a></div>";
echo "</div>";
echo "<div class='linksDiv'><a class='links' href='menu.php'>Retornar ao menu</a></div>";
//echo "[<a href='form_inserir.php'>Inserir Filme</a>]";
//echo "[<a href='logout.php'>Sair</a>]";

echo "</header>";
 ?>
</body>
</html>
