<!DOCTYPE HTML>
<html>
	<head>
		<title>Administração</title>
		<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.0/themes/base/jquery-ui.css" />
		<script src="http://code.jquery.com/jquery-1.8.2.js"></script>
		<script src="http://code.jquery.com/ui/1.9.0/jquery-ui.js"></script>
	</head>
	<script>
    	$(function() {
        	$( "#barra" ).buttonset();
    	});
/*    	$(function() {
       		$("input[type=submit], a, button").button();
    	});
*/
    </script>
	<body>
		<h1 font-face = "Arial">Administração</h1>
		<div id="barra">
	 		<a href="cadastro.php">Cadastrar</a>
	 		<a href="exclusao.php">Excluir</a>
	 		<a href="edicao.php">Editar</a>
	 		<a href="lista.php">Listar</a>
	 	</div>
	</body>
</html>