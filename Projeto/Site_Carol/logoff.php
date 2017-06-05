<?php
	session_start();
	//DELETA VARIÁVEIS DA SESSÃO:
	unset($_SESSION['email']);
	unset($_SESSION['senha']);
	unset($_SESSION['perfil']);
	setcookie('email','',time()-3600); #deleta cookie, //quando dá logoff o cookie é excluido
	echo "<meta http-equiv=refresh content='0; url=login.html'>
	 	<script>
	 		alert('Você fez logoff!');
	 	</script>";
?>