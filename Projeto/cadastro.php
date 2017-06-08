<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>
<<<<<<< HEAD

		<script>
			$(document).on('click',"#botao",function()
			{
				var data = {email:$("#email").val(),senha:$("#senha").val()};
				console.log(data);
				console.log(data['email'])
				if (data['email'].length > 0)
				{
					$.post("cadastrar.php", data, post_done, "json").fail(post_fail);
					$("#email").val("");
					$("#senha").val("");
				}
				else
	   				alert("Preencha os campos corretamente.");
			});
					
			function post_done(data)
			{
			    console.log(data);
			    alert(data);
			}

			function post_fail(data)
			{
				console.log(data);
			 	alert("Error: " + data);
			}
		</script>
=======
		<link href="css/imagedraganddrop.css" media="all" rel="stylesheet" type="text/css" />
		<script src="javascript/cadastrar.js" type="text/javascript"></script>
>>>>>>> cadastro
	</head>
	
	<body>
		<h1><a href="admin.php">Cadastro de Usuários</a></h1>
<<<<<<< HEAD
		<p><label>Email</label>
		<input type="text" name="email" id="email" /></p>
		<p><label>Senha</label>
		<input type="password" name="senha" id="senha" /></p>
=======
		<h3>Preencha os campos abaixo corretamente.</h3>
		<!--h4>Os campos marcados com * são obrigatórios.</h4-->
		<table>
			<tr>
				<td><label>Nome Completo: </label></td>
				<td><input type="text" name="nome" id="nome" size="70" maxlength="70"/></td>
				<td rowspan="4">
					<div id="example-content">
				      <div id="frame">
				        <div id="image-area">
				          <span aligh="center" id="drop-message"> Arraste a imagem <br>aqui </span>
				        </div>
				        <span id="title"> Digite um titulo </span>
				      </div>
				    </div>
				</td>
			</tr>
				<!--label>Sexo: </label>
				<input type="radio" name="sexo" id="masc" checked/>Masculino
				<input type="radio" name="sexo" id="femi"/>Feminino</p>
				<p><label>Data Nascimento: </label>
				<input type="date" name="birth" id="birth"/>
				<label>Endereço: </label>
				<input type="text" name="adress" id="adress" size="73" maxlength="70"/></p>
				<p><label>Bairro: </label>
				<input type="text" name="bairro" id="bairro" size="30" maxlength="30"/>
				<label>Cidade: </label>
				<input type="text" name="cidade" id="cidade"/>
				<label>Estado: </label>
				<select name="estado" id="estado" size="1">
					<option>PE<option>AC<option>AL<option>AP<option>AM<option>BA<option>CE<option>DF<option>ES<option>GO
					<option>MA<option>MT<option>MS<option>MG<option>PA<option>PB<option>PI<option>PR<option>RJ<option>RN
					<option>RS<option>RO<option>RR<option>SC<option>SP<option>SE<option>TO<option>Outro
				</select>
				<label>País: </label>
				<input type="text" name="pais" id="pais" size="25" maxlength="25"/></p>
				<p><label>CEP: </label>
				<input type="text" name="cep" id="cep"/></p-->
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
>>>>>>> cadastro
		<p><button id="botao">Cadastrar</button></p>
		<div id="tabela"></div>
	</body>
	<script src="javascript/imagedraganddrop.js" type="text/javascript"></script>
</html>