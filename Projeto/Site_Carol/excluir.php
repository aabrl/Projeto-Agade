<?php
	include "config.php";
	$email = isset($_POST['email']) ? $_POST['email'] : '';

	if ($email == false) {
		echo "<meta http-equiv=refresh content='0; url=exclusao.php'>
			<script>
				alert('Preencha o campo corretamente!');
			</script>";
	} else {
			$email = $_POST['email'];
			#seleciona os users que tiverem o email com as letras escritas no form exatamente como no db:
			$deleteUsers = pg_query("DELETE FROM usuarios WHERE email = '$email'") or die('Query failed: '.pg_last_error());
			pg_close($conexao);
			echo "<meta http-equiv=refresh content='0; url=exclusao.php'>
				<script>
					alert('O e-mail ".$email." foi excluído!');
				</script>";
	}
?>