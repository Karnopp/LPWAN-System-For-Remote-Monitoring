<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/listaUsuarios.css">
  </head>
  <body>
<?php
//session_start();
include("usuarios.php");

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "SELECT cod, nome, login FROM usuario ORDER BY cod";
$result = mysqli_query($link, $query);

//echo "$query<br>";
echo "<table cellspacing='0' id='tabela'>";
echo "<tr><th class='coluna'>Cod</th>";
echo "<th class='coluna'>Nome</th>";
echo "<th class='coluna'>Login</th>";
echo "<th class='coluna'>Deletar</th>";

while ($row = mysqli_fetch_row($result)) {
	if($_SESSION['id']!=$row[0] and $row[0]!=0){
		echo "<tr><td class='coluna'>".$row[0]."</td>";
		echo "<td class='coluna'>".$row[1]."</td>";
		echo "<td class='coluna'>".$row[2]."</td>";
		echo "<td class='coluna'><a href=\"usuarios_delete.php?codigo=".$row[0]."\">deletar</a>";
		//echo "<td align=center><a href=\"usuarios_delete.php?codigo=".$row[0]."\">deletar</a>";
	}


}
echo "</table>";

mysqli_close($link);

?>
</body>
</html>
