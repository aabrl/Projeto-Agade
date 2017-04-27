<?php
	include "config.php";
	extract($_POST);
			
	$resposta = array();

	$email = isset($_POST['email'])?$_POST['email']:'';
	if ($email == null)
	{
		$query = "SELECT * FROM usuarios";
		$resultado = pg_query($query) or die('Query failed: ' . pg_last_error());
		for ($x = 1; $x = pg_fetch_array($resultado); $x++)
		{
		    $resposta[] = $x;
		}
		echo json_encode($resposta, JSON_NUMERIC_CHECK);
		$pg_close = ($link);
	}
	else
	{
		$email = $_POST['email'];
		$query = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
		$resultado = pg_query($query) or die('Query failed: ' . pg_last_error());
		for ($x = 1; $x = pg_fetch_array($resultado); $x++)
		{
		    $resposta[] = $x;
		}
		echo json_encode($resposta, JSON_NUMERIC_CHECK);
		$pg_close = ($link);
	}
?>