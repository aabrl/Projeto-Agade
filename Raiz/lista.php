<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>

		<script>
			$(document).on('click',"#botao",function()
			{
			    var data = $("#email").val();
   				$.post("listar.php", {email:data}, post_done, "json").fail(post_fail);
			});
					
			function post_done(data)
			{
			    console.log(data);
			    console.log(data[0].email);
			    var s = "</BR><table border=1 align=center><tr><th>NOME</th><th>E-MAIL</th><th>SENHA</th><th>FOTO</th></tr>";
			    for (var i = 0; i < data.length; i++)
			    {
			    	s += "<tr><td>"+data[i].nome+"</td><td>"+data[i].email+"</td><td>"+data[i].senha+"</td><td>"+data[i].foto+"</td></tr>";
			    }
			    s +="</table>";
			    $("#tabela").html(s);
			}

			function post_fail(data)
			{
				console.log(data);
			    console.log(data[0].email);
			 	alert("Error: " + data);
			}
		</script>
	</head>
	<body>
		<h1><a href="admin.php">Listar Usuários</a></h1>
		<label>Email</label><input type="text" id="email" name="email"/>
		<button id="botao" name="botao1">Listar</button>
		<div id="tabela"></div>
	</body>
</html>