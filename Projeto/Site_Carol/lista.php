<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Adm</title>
	</head>

	<body>
		<h1 style="font-family: verdana">Listar Users</h1>
		<form id="form1" name="form1" method="POST">
			E-mail: <input type="text" name="email" id="email" placeholder="example@cin.ufpe.br">
			<br><br>
			<input type="submit" name="submit" id="button" value="Listar">
			<!--Chama o listar.php-->
			<br>
			<p style="font-family: verdana"><a href="edicao.php">Página de Edição</a></p>
			<p style="font-family: verdana"><a href="adm.html">Voltar</a></p>
		</form>

		<?php 
			function display(){
				include "config.php";
				#verifica se os campos estão vazios ou não: 
				$email = isset($_POST['email']) ? $_POST['email'] : '';
				#se false->vazia
				if ($email == false) {
					#seleciona todos os users e mostra
					$todosUsers = pg_query("SELECT * FROM usuarios") or die('Query failed: '.pg_last_error());
					while ($linha = pg_fetch_array($todosUsers)) {
						if ($linha['perfil'] == null) {
							$linha['perfil'] = 'NULL';
						}
						#imprime linha por linha while $linha == true
						echo "Email: ".$linha['email']." / Senha: ".$linha['senha']." / Perfil: ".$linha['perfil']."</br>";
					}
					pg_close($conexao);
				} else {
					$email = $_POST['email'];
					#seleciona os users que tiverem o email com as letras escritas no form em qualquer parte do nome
					$algunsUsers = pg_query("SELECT * FROM usuarios WHERE email LIKE '%$email%'") or die('Query failed: '.pg_last_error());
					while ($linha = pg_fetch_array($algunsUsers)) {
						if ($linha['perfil'] == null) {
							$linha['perfil'] = 'NULL';
						}
						#imprime as linhas que satisfazem a condição do $linha
						echo "Email: ".$linha['email']." / Senha: ".$linha['senha']." / Perfil: ".$linha['perfil']."<br>";
					}
					pg_close($conexao);
				}
			}
			if(isset($_POST['submit'])) { #chama display() quando o submit é setado
				display();
			}
		?>
	</body>
</html>