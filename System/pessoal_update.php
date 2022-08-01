<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Menu</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/pessoal.css">
  </head>
  <body>
    <?php

echo "<header>";
echo "<div id='retorna'>";
echo "<a id='retornar' href='menu.php'>Retornar ao menu</a>";
echo "</header>";
echo "</div>";
session_start();
$codigo = $_SESSION['id'];;
$nome = $_POST['nome'];
$login = $_POST['login'];
$senha = $_POST['senha'];


$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "UPDATE usuario SET nome='$nome', login='$login', senha='$senha' WHERE cod='$codigo'";
//echo "UPDATE: $query<br><hr>";
mysqli_query($link, $query);
mysqli_close($link);

echo 'Usuário atualizado'
?>
</body>
</html>
