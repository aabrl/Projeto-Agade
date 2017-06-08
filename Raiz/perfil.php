<DOCTYPE html>
<?php
	include "verificacao.php";
	$id = $_SESSION['id'];
	$nome = $_SESSION['nome'];
	$email = $_SESSION['email'];
?>
<html lang="pt">
<head>
	<title>MEU PERFIL</title>
	<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
	<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
</head>
<script>
    $(function() {
        $( "#barra" ).buttonset();
    });
</script>
<body>
	<div class="container4">
		<h1 align="center"><a id="home" href="index.html">Meu Perfil</a></h1>
		<?php
			echo "
				<table class='dados' border=1 align=center>
				<tr>
					<td><label>Nome Completo: </label></td>
					<td>".$nome."</td>
					<td rowspan='2'>
						<div>
							<img height='200' width='200' src='uploads/".$id.".jpg'>				
						</div>
					</td>
				</tr>
				<tr>
					<td><label>Email: </label></td>
					<td>".$email."</td>
				</tr>
			</table>";
			pg_close($link);
		?>
		<div align="center" id="barra">
			<a href="logoff.php">Sair</a>
			<a href="#">Editar</a>
		</div>
	</div>
</body>
</html>