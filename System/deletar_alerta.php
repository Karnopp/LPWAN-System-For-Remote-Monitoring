<?php

$codigo = $_POST['codigo'];

$link = mysqli_connect("localhost", "root", "", "sistemaTCC");

$query = "DELETE FROM alerta WHERE cod='$codigo'";
mysqli_query($link, $query);
mysqli_close($link);
header("Location: alertas.php");

?>
