<?php
	include "config.php";
	//PEGA VALORES DAS VARIÁVEIS PELO POST
  	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$senhaCript = md5($senha); #$senhaCript armazena $senha no formato MD5

	#caso o login e senha estejam vazios, ele vai dar um erro no if
	$verificar = pg_query("SELECT FROM usuarios WHERE email = '$email' AND senha = '$senhaCript'") or die("Query failed: ".pg_last_error());

	#compara o email e a senha em md5 com o que tem no db
	$logado = pg_fetch_array($verificar);

	if (pg_num_rows($verificar) == 1) { #se tiver uma linha, então a conta existe

		session_start(); #inicia sessão

		$pesquisa = "SELECT id,nome FROM usuarios WHERE email = '$email' AND senha = '$senhaCript'";
		$resultado = pg_query($pesquisa) or die('Query failed: ' . pg_last_error());
		while ($linha = pg_fetch_array($resultado)) {
			$id = $linha['id'];
			$nome = $linha['nome'];
		}
		#atribuição das variáveis de sessão:
		$_SESSION['id'] = $id;
		$_SESSION['nome'] = $nome;
		$_SESSION['email'] = $email;
		$_SESSION['senha'] = $senhaCript;
		//$_SESSION['perfil'] = $perfil;

		//CASO NÃO TENHA PERFIL:
		if ($_SESSION['email'] == null) {
			echo "
				<script>
					alert('Não existe cadastro vinculado ao e-mail".$email.".');
					parent.location = 'login.html';
				</script>";
			unset($_SESSION['id']);
			unset($_SESSION['nome']);
			unset($_SESSION['email']);
			unset($_SESSION['senha']);
			//unset($_SESSION['perfil']);
		//SE TIVER PERFIL:
		} else {
			echo "
				<script>
					alert('Usuário ".$_SESSION['email']." logado com sucesso!');
					parent.location = 'perfil.php';
				</script>";
		}
	} else { 
		echo "
		 	<script>
		 		alert('Preencha corretamente os campos!');
		 		parent.location = 'login.html';
		 	</script>";
	}

	pg_close($conexao);	#fecha a conexão
?>