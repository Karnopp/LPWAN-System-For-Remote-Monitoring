<?php

$codigo = $_GET['codigo'];

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "UPDATE alerta SET visualizado='sim' WHERE cod='$codigo'";
mysqli_query($link, $query);
mysqli_close($link);
header("Location: alertas.php");

?>
