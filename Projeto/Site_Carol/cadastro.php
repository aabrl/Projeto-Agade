<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Adm</title>
		<!--Scripts-->
		<script src="http://code.jquery.com/jquery-3.2.1.js"></script>
	</head>

	<body>
		<h1 style="font-family: verdana">Cadastro dos Users</h1>
		<form id="form1" name="form1" method="POST" action="cadastrar.php">
			E-mail: <input type="text" name="email" id="email" placeholder="example@cin.ufpe.br">
			<br><br>
			Senha: <input type="password" name="senha" id="senha">
			<br><br>
			<input type="submit" name="submit" id="button" value="Cadastrar">
			<!--Chama o cadastrar.php com o submit-->
			<br>
			<p style="font-family: verdana"><a href="adm.html">Voltar</a></p>
		</form>
	</body>
</html>