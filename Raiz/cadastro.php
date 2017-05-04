<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>

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
	</head>
	
	<body>
		<h1><a href="admin.php">Cadastro de Usuários</a></h1>
		<p><label>Email</label>
		<input type="text" name="email" id="email" /></p>
		<p><label>Senha</label>
		<input type="password" name="senha" id="senha" /></p>
		<p><button id="botao">Cadastrar</button></p>
		<div id="tabela"></div>
	</body>
</html>