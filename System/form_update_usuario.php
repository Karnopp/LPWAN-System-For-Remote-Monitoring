<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <title>Login</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="CSS/usuariosForm.css">
  </head>
  <body>
<?php
	//session_start();
	include("menu.php");
	$link = mysqli_connect("localhost", "root", "", "sistemaTCC");
	$codigo = $_POST['codigo'];
	$query = "SELECT cod, nome, login, senha, funcao FROM usuario WHERE cod=$codigo";
	$result = mysqli_query($link, $query);
	$row = mysqli_fetch_row($result)
?>



<script>
function validaForm(frm){
	let erro = false;
	const estrela1 = document.getElementById("divDaEstrela1");
	const estrela2 = document.getElementById("divDaEstrela2");
	const estrela3 = document.getElementById("divDaEstrela3");
	const estrela4 = document.getElementById("divDaEstrela4");

	if(frm.nome.value.length<1){
		erro=true;
		estrela1.style.display = "block";
	}

	if(frm.login.value.length<1){
		erro=true;
		estrela2.style.display = "block";
	}

	if(frm.senha.value.length<1){
		erro=true;
		estrela3.style.display = "block";
	}
	/*
	if(frm.chat_id_telegram.value.length>=1){
		if(!Number.isInteger(parseInt(frm.chat_id_telegram.value))){
			erro=true;
			estrela4.style.display = "block";
		}
	}
	*/

	if(erro==true) return false;
	else return true;

}
</script>

<section id="conteudoPrincipal">
<form action="usuarios_update.php?codigo=<?php echo $row[0] ?>"  method="post" onsubmit="return validaForm(this);">
<fieldset id="formulario">
<p id="titulo">Editar usuário:</p>

<div Style="display: flex;" class="divEstrela">
<label for="nome" class="labelsForm">Nome: </label>
<input type="text" name="nome" class="camposForm" value="<?php echo $row[1]?>">
<div id="divDaEstrela1" style="display: none"><font color="red">* NAO PODE SER NULO </font></div>
</div>
<br>

<div Style="display: flex;" class="divEstrela">
<label for="login" class="labelsForm">Login: </label>
<input type="text" name="login" class="camposForm" value="<?php echo $row[2]?>">
<div id="divDaEstrela2" style="display: none"><font color="red">* NAO PODE SER NULO </font></div>
</div>
<br>

<div Style="display: flex;" class="divEstrela">
<label for="senha" class="labelsForm">Senha: </label>
<input type="password" name="senha" class="camposForm" value="<?php echo $row[3]?>">
<div id="divDaEstrela3" style="display: none"><font color="red">* NAO PODE SER NULO </font></div>
</div>
<br>

<!--<div Style="display: flex;">
chat_id_telegram: <input type="text" name="chat_id_telegram" value="<?php echo $row[4]?>">
<div id="divDaEstrela4" style="display: none"><font color="red">* DEVE CONTER APENAS NUMEROS </font></div>
</div>
<br><br>-->

<label for="adm" class="labelsForm">Administrador:</label>
<input type="checkbox" name="adm" <?php if ($row[4]=='administrador') echo 'checked';?>><br>
<input type="submit" name="editar" id="botaoEditar" class="botoes" value="Editar">
</form>
</section>
</body>
</html>
