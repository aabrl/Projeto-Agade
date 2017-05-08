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
				console.log(data['email']);
				console.log(data['senha']);
				if (data['senha'].length > 0)
				{
					$.post("editar.php", data, post_done, "json").fail(post_fail);
					$("#email").val("");
					$("#senha").val("");
				}
				else
	   				alert("A senha não pode ficar em branco.");
			});
			$(document).on('click',"#botao2",function()
			{
			    var data = {email:$("#email").val()};
			    console.log(data);
				console.log(data['email']);
   				$.post("listar.php", data, post_done1, "json").fail(post_fail);
			});
					
			function post_done(data)
			{
			    console.log(data);
			    alert(data);
			}

			function post_done1(data)
			{
			    console.log(data);
			    console.log(data[0].email);
			    var s = "</BR><table border=1 align=center><tr><th>E-MAIL</th><th>SENHA</th></tr>";
			    for (var i = 0; i < data.length; i++)
			    {
			    	s += "<tr><td>"+data[i].email+"</td><td>"+data[i].senha+"</td></tr>";
			    }
			    s +="</table>";
			    $("#tabela").html(s);
			}

			function post_fail(data)
			{
				console.log(data);
			 	alert("Error: " + data);
			}
		</script>
	</head>
	<body>
		<h1><a href="admin.php">Edição de Usuários</a></h1>
		<p><label>Email</label><input type="text" name="email" id="email" /></p>
		<p><label>Nova Senha</label><input type="text" name="senha" id="senha" /></p>
		<p><button id="botao">Editar</button><button id="botao2">Listar</button></p>
		<div id="tabela"></div>
	</body>
</html>