<?php
	include "config.php";
	session_start();
	extract($_POST);
	$nomefoto = $_SESSION['nomefoto'];
	$localfoto = $_SESSION['localfoto'];

	if (isset($email))
	{   
		#Insere a foto DENTRO do banco de dados
		#$query = "INSERT INTO usuarios(nome,email,senha,foto) VALUES ('$nome', '$email', '$senha',lo_import('C:/wamp64/www/Site/Raiz/uploads/foto.jpg'))";
		#Insere apenas o caminho da foto no banco de dados
		$senha = $_POST['senha'];
		$senhaCript = md5($senha);
		#INSERINDO CADASTRO NO BD
		$insere = "INSERT INTO usuarios(nome,email,senha) VALUES ('$nome', '$email', '$senhaCript')";
		$resultado = pg_query($insere) or die('Query failed: ' . pg_last_error());
		#RECUPERANDO ID PRA RENOMEAR A FOTO
		$pesquisaid = "SELECT id FROM usuarios WHERE email = '$email'";
		/*$insert_query = pg_query($conexao, "SELECT lastval()");
		$id = pg_fetch_row($insert_query);
		return $id[0];*/
		$resultado = pg_query($pesquisaid) or die('Query failed: ' . pg_last_error());
		while ($linha = pg_fetch_array($resultado)) {
			$id = $linha['id'];
		}
		pg_close($link);
		rename($localfoto.$nomefoto, $localfoto.$id.".jpg");
		$ok = "Usuário ".$nome." cadastrado com sucesso!";
		echo json_encode($ok, JSON_NUMERIC_CHECK);
	}
?>