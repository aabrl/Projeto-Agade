<?php
	include "config.php";

	session_start(); #inicia sessão

	//VERIFICA SE REALMENTE TEM A CONTA NO DB 
	if (isset($_SESSION['email']) && isset($_SESSION['senha'])) { #se a sessão estiver ativa:

		//ATRIBUI VARIÁVEIS LOCAIS AS VARIÁVEIS GLOBAIS DE SESSÃO
		$email = $_SESSION['email']; #sessão atribuída a var
		$senhaCript = $_SESSION['senha']; #sessão atribuída a var
		//$perfil = $_SESSION['perfil']; #sessão atribuída a var

		#faz a query para verificar se o login e senha feitos batem com o login e senha da sessão permitida:
		$verificar = pg_query("SELECT FROM usuarios WHERE email = '$email' AND senha = '$senhaCript'") or die("Query failed: ".pg_last_error());

		//SE A CONTA NÃO ESTIVER NO DB
		if (pg_num_rows($verificar) == 0) { #se = 0, a conta não está no db, pois o retorno de $verificar seriam 0 linhas retornadas da query
			#e, com isso, dá o logoff:
			unset($_SESSION['id']);
			unset($_SESSION['nome']);
			unset($_SESSION['email']);
			unset($_SESSION['senha']);
			//unset($_SESSION['perfil']);
			echo "
				<script>
					alert('Nome de usuário e/ou senha inválido(s).');
					parent.location = 'login.html';
				</script>";
		}

	//SE A SESSÃO NÃO ESTIVER ATIVA
	} else { #caso a sessão não esteja ativa:
		unset($_SESSION['id']);
		unset($_SESSION['nome']);
		unset($_SESSION['email']);
		unset($_SESSION['senha']);
		//unset($_SESSION['perfil']);
		echo "
		 	<script>
		 		alert('Você não está logado!');
		 		parent.location = 'login.html';
		 	</script>";
	}
	#NÃO fechar a conexão nesse arquivo!!!!!! (por enquanto)
?>