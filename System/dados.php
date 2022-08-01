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
    ?>
    <section id='ladoalado'>
    <div id='divBotaozao'>
    <form action='dados_abelha.php'>
      <button id='botaozao'>Caixa de abelhas</button>
    </form>
    </div>

    <div id='divBotaozao2'>
    <form action='dados_agua.php'>
      <button id='botaozao2'>Tanque de água</button>
    </form>
    </div>

    <div id='divBotaozao3'>
    <form action='dados.php'>
      <button id='botaozao3'>Aplicação N</button>
    </form>
    </div>
    </section>
  </body>
</html>
