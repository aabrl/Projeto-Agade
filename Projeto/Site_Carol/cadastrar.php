<?php	
	include "config.php";

	//VERIFICA SE CAMPOS ESTÃO SETADOS:
	$email = isset($_POST['email']) ? $_POST['email'] : ''; #é tipo um if else estilizado
	$senha = isset($_POST['senha']) ? $_POST['senha'] : ''; #isset($_POST['senha'])? Se false, $_POST['senha'] = '' (vazio)

	#se false->vazia
	if ($email == false || $senha == false) {
	 	echo "
		 	<script>
		 		alert('Preencha corretamente os campos!');
		 		parent.location = 'cadastro.php';
		 	</script>";
	 } else { #se true->preenchida
	 	#pega as variáveis pelo POST:
	 	$email = $_POST['email'];
	 	$senha = $_POST['senha'];
	 	#$senha em MD5
	 	$senhaCript = md5($senha);
	 	//$confereUser = pg_query("SELECT * FROM usuarios WHERE email = '$email'") or die('Query failed: '.pg_last_error());
	 	//confere se user existe no bd:
	 	if (pg_query("SELECT * FROM usuarios WHERE email = '$email'") or die('Query failed: '.pg_last_error())) {
	 		echo "
	 			<script>
	 				alert('Email já cadastrado no db!');
	 				parent.location = 'cadastro.php';
	 			</script>";
	 		pg_close($conexao);
		} else {

		//if (!$confereUser) { //caso seja realmente novo user
		 	#insere dados na tabela
		 	pg_query("INSERT INTO usuarios(email,senha) VALUES ('$email','$senhaCript')") or die('Query failed: '.pg_last_error());
		 	#fecha conexão
		 	pg_close($conexao);

		 	echo "
			 	<script>
			 		alert('O email ".$email." foi cadastrado com sucesso.');
			 		parent.location = 'cadastro.php';
			 	</script>";
		}
	 }
?>