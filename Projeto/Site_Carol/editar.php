<?php
	include "config.php";
	#verifica se os campos estão vazios ou não: 
	$email = isset($_POST['email']) ? $_POST['email'] : '';
	$senha = isset($_POST['senha']) ? $_POST['senha'] : '';
	$novaSenha = isset($_POST['novaSenha']) ? $_POST['novaSenha'] : '';
	#se false->vazia
	if ($email == false || $senha == false || $novaSenha == false) { //campos não estão completos
		echo "
		 	<script>
		 		alert('Preencha corretamente os campos!');
		 		parent.location = 'edicao.php';
		 	</script>";
	} else {
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$novaSenha = $_POST['novaSenha'];
		$senhaCript = md5($senha);
		$novaSenhaCript = md5($novaSenha);
		#verifica se user existe no db
		$editaUsers = pg_query("SELECT * FROM usuarios WHERE email='$email' AND senha = '$senhaCript'") or die('Query failed: '.pg_last_error());
		if (pg_num_rows($editaUsers) == 1) {
			//verifica se as duas senhas atuais são iguais ou difentes
			if ($senhaCript != $novaSenhaCript) { //se forem diferentes
				//dá o update aqui
				pg_query("UPDATE usuarios SET senha = '$novaSenhaCript' WHERE email = '$email'") or die('Query failed: '.pg_last_error());
				echo "
					<script>
						alert('Senha editada com sucesso!');
						parent.location = 'edicao.php';
					</script>";
			} else { //se forem iguais
				echo "
					<script>
						alert('As senhas digitadas são iguais!');
						parent.location = 'edicao.php';
					</script>";
			}
		} else {
			echo "
				<script>
					alert('Email não está cadastrado ou a senha atual não é correta!');
					parent.location = 'edicao.php';
				</script>";
		}
		pg_close($conexao);
	}
?>