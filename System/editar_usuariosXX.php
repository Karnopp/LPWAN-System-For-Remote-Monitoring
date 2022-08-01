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
include("menu.php");

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "SELECT cod, nome, login FROM usuario ORDER BY cod";
$result = mysqli_query($link, $query);

//echo "$query<br>";
echo "<table cellspacing='0' id='tabela'>";
echo "<tr><th class='coluna'>Cod</th>";
echo "<th class='coluna'>Nome</th>";
echo "<th class='coluna'>Login</th>";
echo "<th class='coluna'>Editar</th>";
//echo "<th class='coluna'>&nbsp;</th>";

while ($row = mysqli_fetch_row($result)) {
	if($row[0]!=1){
		echo "<tr><td class='coluna'>".$row[0]."</td>";
		echo "<td class='coluna'>".$row[1]."</td>";
		echo "<td class='coluna'>".$row[2]."</td>";
		echo "<td class='coluna'><a href=\"form_update_usuario.php?codigo=".$row[0]."\">editar</a>";
	}

}
echo "</table>";

mysqli_close($link);

?>
</body>
</html>
