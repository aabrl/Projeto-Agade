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
</head>
<body>
	<h1><a href="index.html">Meu Perfil</a></h1>
	<?php
		echo "
			<table border=1 align=center>
			<tr>
				<td><label>Nome Completo: </label></td>
				<td>".$nome."</td>
				<td rowspan='2'>
					<div>
						<img src='uploads/".$id.".jpg'>				
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
	<p><a href="logoff.php">Logoff</a></p>
</body>
</html>