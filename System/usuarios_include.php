<?php
//session_start();
include("menu.php");

$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];
//$chat_id_telegram = $_POST['chat_id_telegram'];
if (isset($_POST['adm'])) {
    $adm="administrador";
} else {
    $adm="comum";
}

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "INSERT INTO usuario (nome, login, senha, funcao) VALUES ('$nome', '$login', '$senha', '$adm')";
//echo " $query<br><hr>";
mysqli_query($link, $query);
mysqli_close($link);

echo"Usuário cadastrado!";

?>
