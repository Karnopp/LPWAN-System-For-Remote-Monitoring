<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Usuários</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/listaUsuarios.css">
  </head>
  <body>
<?php
//session_start();
include("menu.php");
echo "<div id='botaoIncluir'><a id='incluir' href='form_usuarios_include.php'>Incluir novo usuário</a></div>";

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "SELECT cod, nome, login, chat_id_telegram FROM usuario ORDER BY cod";
$result = mysqli_query($link, $query);

echo "<p class='subtitulo'>Lista de todos usuários</p>";
echo "<table id='tabela' cellspacing='0'>";
echo "<tr><th class='coluna'>Cod</th>";
echo "<th class='coluna'>Nome</th>";
echo "<th class='coluna'>Login</th>";
echo "<th class='coluna'>Editar</th>";
echo "<th class='coluna'>Excluir</th>";
//echo "<td align=center><b>&nbsp;</b></td>";

while ($row = mysqli_fetch_row($result)) {
  if($_SESSION['id']!=$row[0] and $row[0]!=0){
  	echo "<tr><td class='coluna'>".$row[0]."</td>";
  	echo "<td class='coluna'>".$row[1]."</td>";
  	echo "<td class='coluna'>".$row[2]."</td>";
  	echo "<td class='coluna'>";
    echo "<form action='form_update_usuario.php' method='POST''>";
    echo "<input type='hidden' name='codigo' value=".$row[0].">";
    echo "<button type='submit' class='botoes'><img src='IMG/edit.png' class='imagens'></button>";
    echo "</form></td>";
    echo "<td class='coluna'>";
    echo "<form action='usuarios_delete.php' method='POST''>";
    echo "<input type='hidden' name='codigo' value=".$row[0].">";
    echo "<button type='submit' class='botoes'><img src='IMG/exclude.png' class='imagens'></button>";
    echo "</form></td>";
  	//echo "<td align=center><a href=\"deletar.php?codigo=".$row[0]."\">deletar</a>";
  }
}
echo "</table>";
mysqli_close($link);

?>
</body>
</html>
