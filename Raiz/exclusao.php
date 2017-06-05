<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>

		<script>
			$(document).on('click',"#botao",function()
			{
				var data = {email:$("#email").val()};
				console.log(data);
				console.log(data['email'])
				if (data['email'].length > 0)
				{
					$.post("excluir.php", data, post_done, "json").fail(post_fail);
					$("#email").val("");
				}
				else
	   				alert("Preencha os campos corretamente.");
			});
			$(document).on('click',"#botao2",function()
			{
			    var data = {email:$("#email").val()};
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
			    var s = "</BR><table border=1 align=center><tr><th>ID</th><th>NOME</th><th>E-MAIL</th></tr>";
			    for (var i = 0; i < data.length; i++)
			    {
			    	s += "<tr><td>"+data[i].id+"</td><td>"+data[i].nome+"</td><td>"+data[i].email+"</td></tr>";
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
		<h1><a href="index.html">Consulta/Exclusão de Usuários</a></h1>
		<p><label>Email</label>
		<input type="text" name="email" id="email" /></p>
		<p><button id="botao">Excluir</button><button id="botao2">Listar</button></p>
		<div id="tabela"></div>
	</body>
</html>