<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Adm</title>
	</head>

	<body>
		<h1 style="font-family: verdana">Exclusão dos Users</h1>
		<form id="form1" name="form1" method="POST" action="excluir.php">
			E-mail: <input type="text" name="email" id="email" placeholder="example@cin.ufpe.br">
			<br><br>
			<input type="submit" name="submit" id="button1" value="Excluir">
			<!--Chama o excluir.php com o submit-->
			<br><br>
		</form>

		<form id="form2" name="form2" method="POST">
			<input type="submit" name="button" id="button2" value="Listar">
			<br>
			<p style="font-family: verdana"><a href="adm.html">Voltar</a></p>
		</form>

		<!--Usado pra listar as entradas na página-->
		<?php
			function display(){
				include "config.php";
				#seleciona todos os users e mostra:
				$todosUsers = pg_query("SELECT * FROM usuarios") or die('Query failed: '.pg_last_error());
				while ($linha = pg_fetch_array($todosUsers)) {
					if ($linha['perfil'] == null) {
							$linha['perfil'] = 'NULL';
					}
					#imprime linha por linha while $linha == true
					echo "Email: ".$linha['email']." / Senha: ".$linha['senha']." / Perfil: ".$linha['perfil']."</br>";
				}
				pg_close($conexao);
			}
			if(isset($_POST['button'])) { #chama display() quando o button é setado
				display();
			}
		?>
	</body>
</html>