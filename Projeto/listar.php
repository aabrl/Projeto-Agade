<!DOCTYPE HTML>
<html>
	<head>
		<title>Admininistração</title>
	</head>
	<?php
		include "config.php";
	?>
	<body>
		<h1><a href="admin.php">Lista Usuários</a></h1>
		<?php
			$email = isset($_POST['email'])?$_POST['email']:'';
			if ($email == null)
			{
				$query = "SELECT * FROM usuarios";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				while($linha = pg_fetch_array($result))
				{
					echo "Email: ".$linha['email']." - Senha: ".$linha['senha']."</br>";
				}
			$pg_close = ($link);
			}
			else
			{
				$email = $_POST['email'];
				$query = "SELECT * FROM usuarios WHERE email LIKE '%$email%'";
				$result = pg_query($query) or die('Query failed: ' . pg_last_error());
				while($linha = pg_fetch_array($result))
				{
					echo "Email: ".$linha['email']." - Senha: ".$linha['senha']."</br>";
				}
			$pg_close = ($link);
			}
		?>
		<form id="form1" name="form1" method="post" action="listar.php">
		  <p><label for="Email">Email</label>
		  <input type="text" name="email" id="email" /></p>
		  <input type="submit" name="button" id="button" value="Listar" />
		</form>
	</body>
</html>