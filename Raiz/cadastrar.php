<?php
	include "config.php";
	$email = isset($_POST['email'])?$_POST['email']:'';

	if ($email == null){
		echo "<meta http-equiv=refresh content='0; url=admin.php'>
			<script type=\"text/javascript\">
			alert(\"Preencha os campos corretamente.\");
			</script>";
	}
	else{
		$email = $_POST['email'];
		$senha = $_POST['senha'];

		$query = "INSERT INTO usuarios(email,senha) VALUES ('$email', '$senha')";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$pg_close = ($link);
		echo "<meta http-equiv=refresh content='0; url=admin.php'>
			<script type=\"text/javascript\">
			alert(\"O email ".$email." foi cadastrado com sucesso.\");
			</script>";
	}
?>