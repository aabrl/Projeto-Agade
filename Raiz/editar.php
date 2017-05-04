<?php
	include "config.php";
	extract($_POST);
	
	if (isset($email))
	{
		$a = 0;
		$query1 = "SELECT * FROM usuarios WHERE email = '$email'";
		$result = pg_query($query1) or die('Query failed: ' . pg_last_error());
		for ($x = 1; $x = pg_fetch_array($result); $x++)
		{
			$a++;
		}
		if ($a > 0)
		{
			$query2 = "UPDATE usuarios SET senha = '$senha' WHERE email = '$email'";
			$resultado = pg_query($query2) or die('Query failed: ' . pg_last_error());
			$resposta = "A senha para ".$email." foi editada com sucesso!";
			echo json_encode($resposta, JSON_NUMERIC_CHECK);
		}
		else
		{
			$resposta = "Email inexistente.";
			echo json_encode($resposta, JSON_NUMERIC_CHECK);
		}
	}
	$pg_close = ($link);
?>
