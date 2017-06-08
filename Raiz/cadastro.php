<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>
        <link rel="stylesheet" href="css/imagedraganddrop2.css" />
		<script src="javascript/cadastrar.js" type="text/javascript"></script>
	</head>
	
	<body>
		<h1><a href="index.html">Cadastro de Usuários</a></h1>
		<h3>Preencha os campos abaixo corretamente.</h3>
		<!--h4>Os campos marcados com * são obrigatórios.</h4-->
		<table>
			<tr>
				<td><label>Nome Completo: </label></td>
				<td><input type="text" name="nome" id="nome" size="70" maxlength="70"/></td>
				<td rowspan="4">
					<div id="dropbox">
						<span class="message">Arraste aqui a sua foto. <br /><i>(Ela só fica visível para você)</i></span>				
					</div>
					<!--form method="post" target="dropbox">
						<input type="file" name="imagem">
					</form-->
				</td>
			</tr>
			<tr>
				<td><label>Email: </label></td>
				<td><input type="email" name="email" id="email" size="50" maxlength="50"/></td>
			</tr>
			<tr>
				<td><label>Senha: </label></td>
				<td><input type="password" name="senha1" id="senha1" maxlength="20"/></td>
			</tr>
			<tr>
				<td><label>Confirmar Senha: </label></td>
				<td><input type="password" name="senha2" id="senha2" maxlength="20"/></td>
			</tr>
		</table>
		<p><button id="botao">Cadastrar</button></p>
		<div id="tabela"></div>
	</body>

	<!-- Including The jQuery Library -->
	<script src="http://code.jquery.com/jquery-1.6.3.min.js"></script>
		
	<!-- Including the HTML5 Uploader plugin -->
	<script src="javascript/jquery.filedrop.js"></script>
		
	<!-- The main script file -->
    <script src="javascript/script.js"></script>
</html>