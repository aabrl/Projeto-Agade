<?php
	include "config.php";
	extract($_POST);
	
	$resposta = array();

	if (isset($email))
	{
		$query = "INSERT INTO usuarios(email,senha) VALUES ('$email', '$senha')";
		$resultado = pg_query($query) or die('Query failed: ' . pg_last_error());
		$pg_close = ($link);
		$ok = "Email ".$email." cadastrado com sucesso!";
		echo json_encode($ok, JSON_NUMERIC_CHECK);
	}
?>