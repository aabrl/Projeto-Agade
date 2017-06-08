<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Adm</title>
		<!--Scripts-->
		<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
	</head>

	<body>
		<h1 style="font-family: verdana">Edição dos Users</h1>
		<form id="form1" name="form1" method="POST" action="editar.php">
			INSERE FOTO AQUI
			<br><br>
			E-mail: <input type="text" name="email" id="email" placeholder="example@cin.ufpe.br">
			<br><br>
			Senha Atual: <input type="password" name="senha" id="senha">
			<br><br>
			Nova Senha: <input type="password" name="novaSenha" id="novaSenha">
			<br><br>
			<input type="submit" name="editar" id="editar" value="Editar">
			<br>
			<p style="font-family: verdana"><a href="lista.php">Página de Listagem</a></p>
			<p style="font-family: verdana"><a href="adm.html">Voltar</a></p>
		</form>
	</body>
</html>