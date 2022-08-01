<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Vizualizar Dados Sensores</title>
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
//echo "<center>Logado com: ".$_SESSION['id']."</center>";


$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "SELECT * FROM caixa_abelha ORDER BY dia DESC, horario DESC";
$result = mysqli_query($link, $query);
/*?><!--to escrevendo em html-->
<form action=""><!--caminho para a pag dos dados-->
  <button><!--coloca uma class no botão pra tirar a borda e o plano de fundo-->
    <img src=""><!--aqui vai o caminho para a imagem que tu quer--><!--coloca uma class na imagem pra ajustar o tamanho-->
  </button>
</form><!--repete a mesma coisa 2 vezes, uma pra cada pagina (abelha e caixa de agua)>
<?php*/
echo "<section id=esquerda>";
echo "<div class='subtitulo'><p>Tabela</p></div>";
echo "<div style='overflow: auto; width: 315px; height: 450px' id='divTabela'>";
echo "<table id='tabela' cellspacing='0'>";
echo "<tr><th class='coluna' >Peso (gramas)</th>";
echo "<th class='coluna' >Data</th>";
echo "<th class='coluna' >Horário</th>";
//echo "<th ><b>&nbsp;</b></th>";

while ($row = mysqli_fetch_row($result)) {
	echo "<tr><td class='coluna' >".$row[1]."</td>";
	echo "<td class='coluna' >".$row[3]."</td>";
	echo "<td class='coluna' >".$row[4]."</td>";
	//echo "<td ><a href=\"deletar.php?codigo=".$row[0]."\">deletar</a>";

}
echo "</table>";
echo " </div>";
echo"</section>";

//echo "Caixa de abelha<br>";
//echo "<table border=\"1\">";
//echo "<tr><td ><b>cod</b></td>";
//echo "<td align=center><b>peso</b></td>";
//echo "<td align=center><b>data</b></td>";
//echo "<td align=center><b>horario</b></td>";
//echo "<td align=center><b>&nbsp;</b></td>";

//while ($row = mysqli_fetch_row($result)) {
	//echo "<tr><td align=center>".$row[0]."</td>";
	//echo "<td align=center>".$row[1]."</td>";
	//echo "<td align=center>".$row[3]."</td>";
	//echo "<td align=center>".$row[4]."</td>";
	//echo "<td align=center><a href=\"deletar.php?codigo=".$row[0]."\">deletar</a>";

//}
//echo "</table><hr>";

//mysqli_close($link);
echo "<section id=direita>";
echo "<div class='subtitulo'><p>Gráfico</p></div>";
echo "<div id='grafico'>";
?>


    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Peso (miligramas)'],
          <?php
          $query = "SELECT * FROM caixa_abelha ORDER BY dia DESC, horario DESC";
          $result = mysqli_query($link, $query);
          while ($row = mysqli_fetch_row($result)) {
            $data = explode("-", $row[3]);
            $tempo = explode(":", $row[4]);
            echo "[new Date(".$data[0].",".(string)((int)$data[1]-1).",".$data[2].",".$tempo[0].",".$tempo[1].",".$tempo[2]."),".(float)$row[1]."],";
          }
          mysqli_close($link);
          ?>
        ]);

        var options = {
          //title: 'Caixa de abelha',
          curveType: 'function',
          width: 800,
          height: 400,
          legend: { position: 'bottom' },
           backgroundColor: { fill: "#cfcfcf" },
           hAxis: {gridlines: {color: '#ffffff'}},
           vAxis: {gridlineColor: '#ffffff'}
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>

    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </div>
  </section>
  </body>
</html>
