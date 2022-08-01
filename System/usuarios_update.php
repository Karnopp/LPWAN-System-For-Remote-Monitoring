<?php

include("menu.php");

$codigo = $_GET['codigo'];
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

$query = "UPDATE usuario SET nome='$nome', login='$login', senha='$senha', funcao='$adm' WHERE cod='$codigo'";
//echo "UPDATE: $query<br><hr>";
mysqli_query($link, $query);
mysqli_close($link);

echo 'Usuário atualizado'
?>
