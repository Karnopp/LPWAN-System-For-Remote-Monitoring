<?php
//session_start();
include("menu.php");

$codigo = $_POST['codigo'];

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "DELETE FROM usuario WHERE cod='$codigo'";
//echo "$query<br><hr>";
mysqli_query($link, $query);
mysqli_close($link);
echo"Usuário deletado!";
?>
