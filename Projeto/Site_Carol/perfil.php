<?php
	include "verificacao.php";
	//DE ACORDO COM O PERFIL, REDIRECIONA PRA PÁGINA CORRETA:
	if ($perfil == 'adm') {
		header('Location: pagAdm.php');
	} else  if ($perfil == 'curador') {
		header('Location: pagCurador.php');
	} else if ($perfil == 'usuario') {
		header('Location: pagUsuario.php');
	} else {
		//unset para evitar problemas
		unset($_SESSION['email']);
		unset($_SESSION['senha']);
		unset($_SESSION['perfil']);
		setcookie('email','',time()-3600); #deleta cookie, caso tenha sido criado. Desnecessário?
		echo "
			<script>
				alert('Houve algum erro, não existe perfil associado a sua conta!');
				parent.location = 'login.html';
			</script>";
	}
	pg_close($conexao);	#fecha a conexão
?>