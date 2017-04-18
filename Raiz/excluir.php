<?php
	include "config.php";
	$email = isset($_POST['email'])?$_POST['email']:'';

	if ($email == null){
		echo "<meta http-equiv=refresh content='0; url=admin.php'>
			<script type=\"text/javascript\">
			alert(\"Preencha o campo corretamente!\");
			</script>";
	}
	else{
		$email = $_POST['email'];

		$query = "DELETE FROM usuarios WHERE email = '$email'";
		$result = pg_query($query) or die('Query failed: ' . pg_last_error());
		$pg_close = ($link);
		echo "<meta http-equiv=refresh content='0; url=exclusao.php'>
			<script type=\"text/javascript\">
			alert(\"O email ".$email." foi excluido com sucesso.\");
			</script>";
	}
?>