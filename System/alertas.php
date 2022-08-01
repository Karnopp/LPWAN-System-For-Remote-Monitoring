<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Alertas</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <link rel="stylesheet" href="CSS/dadosSensores.css">
  </head>
  <body>
<?php
//session_start();
include("menu.php");
if (!isset($_SESSION['id'])) {
    header("location: login.html");
}

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "SELECT * FROM alerta ORDER BY cod desc";
$result = mysqli_query($link, $query);


//echo "$query<br>";
echo"<div id='centro'>";
echo "<div style='overflow: auto; width: 500px; height: 450px'>";
echo "<table cellspacing=0 id='tabela'>";
//echo "<tr><td class='coluna'><b>Pendência</b></td>";
echo "<tr><td class='coluna'><b>Alerta</b></td>";
echo "<td class='coluna'><b>Data</b></td>";
echo "<td class='coluna'><b>Horário</b></td>";
echo "<td class='coluna'><b>Deletar</b></td>";

//echo "<td ><b>&nbsp;</b></td>";

while ($row = mysqli_fetch_row($result)) {
  if($row[4]=="vermelho"){
    //echo "<tr id='vermelho'><td class='coluna'><a href='alterar_alerta.php?codigo=".$row[0]."'><font color='#000000'>Pendente!</font></a></td>";
    echo "<tr id='vermelho'><td class='coluna'><font color='#000000'>$row[1]</font></td>";
  }
  if($row[4]=="verde"){
    echo "<tr id='verde'><td class='coluna'><font color='#000000'>$row[1]</font></td>";
  }
  if($row[4]=="amarelo"){
    echo "<tr id='amarelo'><td class='coluna'><font color='#000000'>$row[1]</font></td>";
  }

	//echo "<td class='coluna'>".$row[1]."</td>";
	echo "<td class='coluna'>".$row[2]."</td>";
	echo "<td class='coluna'>".$row[3]."</td>";
  echo "<td class='coluna'>";
  echo "<form action='deletar_alerta.php' method='POST''>";
  echo "<input type='hidden' name='codigo' value=".$row[0].">";
  echo "<button type='submit' class='botoes'><img src='IMG/exclude.png' class='imagens'></button>";
  echo "</form></td>";

}
echo "</table>";
echo"</div>";
echo"</div>";

mysqli_close($link);

?>

</body>
</html>
