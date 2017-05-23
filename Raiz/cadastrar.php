<?php
	include "config.php";
	extract($_POST);

	if (isset($email))
	{   
		#Insere a foto DENTRO do banco de dados
		#$query = "INSERT INTO usuarios(nome,email,senha,foto) VALUES ('$nome', '$email', '$senha',lo_import('C:/wamp64/www/Site/Raiz/uploads/foto.jpg'))";
		#Insere apenas o caminho da foto no banco de dados
		$query = "INSERT INTO usuarios(nome,email,senha) VALUES ('$nome', '$email', '$senha')";
		$resultado = pg_query($query) or die('Query failed: ' . pg_last_error());
		$pg_close = ($link);
		$ok = "Usuário ".$nome." cadastrado com sucesso!";
		echo json_encode($ok, JSON_NUMERIC_CHECK);
	}
?>