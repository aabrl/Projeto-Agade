<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
		<script src="javascript/jquery-3.2.1.js"></script>

		<script>
			$(document).ready(function()
			{
				$("#botao").click(function()
			    {
			    	var data = $('#email');
   				    $.post("listar.php", data, post_done, "json").fail(post_fail);
			    });
			});

						
			function post_done(data)
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
			    console.log(data[0].email);
			 	alert("Error: " + data);
			}
		</script>
	</head>
	<body>
		<h1><a href="admin.php">Listar Usuários</a></h1>
		<form id="form1" name="form1" method="post">
		  <p><label for="Email">Email</label>
		  <input type="text" name="email" id="email" /></p>
		  <input type="submit" name="botao" id="botao" value="Listar" />
		</form>
		<div id="tabela"></div>
	</body>
</html>