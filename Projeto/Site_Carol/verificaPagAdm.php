<?php 
	include "verificacao.php";
	if (isset($_SESSION['email']) && isset($_SESSION['senha']) && isset($_SESSION['perfil'])) {
		$perfil = $_SESSION['perfil'];
		$este_perfil = 'adm';
		if ($perfil != $este_perfil) {
			echo "
				<script>
					alert('Você não tem permissão pra acessar essa página!!!');
					parent.location = 'perfil.php';
				</script>";
		}
	} else {
		echo "
				<script>
					alert('Você não tem permissão pra acessar essa página!!!');
					parent.location = 'login.html';
				</script>";
	}
?>