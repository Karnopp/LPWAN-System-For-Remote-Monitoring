<?php
//session_start();
//if (!isset($_SESSION['id'])) {
//    header("location: login.html");
//}


//echo "<center>Logado com: ".$_SESSION['id']."</center>";
//echo "<hr>";
//echo "<center>";
//echo "[<a href='menu.php'>Retornar ao menu</a>]";
//echo "[<a href='logout.php'>Sair</a>]";
//echo "[<a href='form_inserir.php'>Inserir Filme</a>]";
//echo "[<a href='logout.php'>Sair</a>]";
//echo "</center>";
//echo "<hr><br>";

$mensagem=$_COOKIE['msg_mqtt'];



$mensagem_dividida = explode("/", $mensagem);

if($mensagem_dividida[0]=="NIVEL"){
  $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
  $query = "SELECT * from nivel_agua WHERE nivel='$mensagem_dividida[1]' and dia='$mensagem_dividida[3]' and horario='$mensagem_dividida[5]'";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_row($result);
  if(!isset($row[0]))
  {
    mysqli_close($link);
    $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
    $query = "INSERT INTO nivel_agua (nivel, dia, horario) VALUES ('$mensagem_dividida[1]','$mensagem_dividida[3]', '$mensagem_dividida[5]')";
    mysqli_query($link, $query);
    mysqli_close($link);
    if($mensagem_dividida[1]=="BAIXO"){
      $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
      $query = "INSERT INTO alerta (mensagem, dia, horario, cor) VALUES ('Tanque de água baixo','$mensagem_dividida[3]', '$mensagem_dividida[5]', 'vermelho')";
      mysqli_query($link, $query);
      mysqli_close($link);
    }
    else{
      $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
      $query = "INSERT INTO alerta (mensagem, dia, horario, cor) VALUES ('Tanque de água alto','$mensagem_dividida[3]', '$mensagem_dividida[5]', 'verde')";
      mysqli_query($link, $query);
      mysqli_close($link);
    }
  }


}
if($mensagem_dividida[0]=="PESO"){
  $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
  $query = "SELECT * from caixa_abelha WHERE peso='$mensagem_dividida[1]' and dia='$mensagem_dividida[3]' and horario='$mensagem_dividida[5]'";
  $result = mysqli_query($link, $query);
  $row = mysqli_fetch_row($result);
  if(!isset($row[0]))
  {
    mysqli_close($link);
    $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
    $query = "INSERT INTO caixa_abelha (peso, dia, horario) VALUES ('$mensagem_dividida[1]', '$mensagem_dividida[3]', '$mensagem_dividida[5]')";
    mysqli_query($link, $query);
    mysqli_close($link);
    if((float)$mensagem_dividida[1]>=8000){
      $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
      $query = "INSERT INTO alerta (mensagem, dia, horario, cor) VALUES ('Caixa de abelha a cima de 80%','$mensagem_dividida[3]', '$mensagem_dividida[5]', 'vermelho')";
      mysqli_query($link, $query);
      mysqli_close($link);
    }
    elseif ((float)$mensagem_dividida[1]>=5000){
      $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
      $query = "INSERT INTO alerta (mensagem, dia, horario, cor) VALUES ('Caixa de abelha entre 50% e 80%','$mensagem_dividida[3]', '$mensagem_dividida[5]', 'amarelo')";
      mysqli_query($link, $query);
      mysqli_close($link);
    }
    else{
      $link = mysqli_connect("localhost", "root", "", "sistemaTCC");
      $query = "INSERT INTO alerta (mensagem, dia, horario, cor) VALUES ('Caixa de abelha abaixo de 50%','$mensagem_dividida[3]', '$mensagem_dividida[5]', 'verde')";
      mysqli_query($link, $query);
      mysqli_close($link);
    }
  }

}

$pagina_dividida = explode("sistema_tcc/", $_COOKIE['pagina']);
header("Location: $pagina_dividida[1]" );
?>
