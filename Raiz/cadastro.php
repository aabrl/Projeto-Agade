<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>

		<script>
			$(document).ready(function()
			{
			    $("button").click(function()
			    {
			    	var data = {nome: "Andre Loponte", cidade: "Recife"};
   				    $.post("teste.php", data, post_success).error(post_error);
			    });
			});

						
			function post_success(data)
			{
			 	alert("Success: " + data);
			}

			function post_error(data)
			{
			 	alert("Error: " + data);
			}
		</script>
	</head>
	
	<body>
		<h1><a href="admin.php">Cadastro de Usuários</a></h1>
		<!--form id="form1" name="form1" method="post">
		  <p><label for="Email">Email</label>
		  <input type="text" name="email" id="email" />
		  <span class="msgerro"></span></p>
		  <p><label for="Senha">Senha</label>
		  <input type="password" name="senha" id="senha" /></p>
		  <input type="submit" name="button" id="button" value="Cadastrar" />
		</form-->
		<button>TESTE</button>
		<div id="tabela"></div>
	</body>
</html>