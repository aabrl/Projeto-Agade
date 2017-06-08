<?php
	include "config.php";
	//PEGA VALORES DAS VARIÁVEIS PELO POST
  	$email = $_POST['email'];
	$senha = $_POST['senha'];
	$senhaCript = md5($senha); #$senhaCript armazena $senha no formato MD5

	#caso o login e senha estejam vazios, ele vai dar um erro no if
	$verificar = pg_query("SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senhaCript'") or die("Query failed: ".pg_last_error());
	#compara o email e a senha em md5 com o que tem no db
	$logado = pg_fetch_array($verificar);

	if (pg_num_rows($verificar) == 1) { #se tiver uma linha, então a conta existe

		/*
		Seria ideal que, após verificar a existência da conta, o browser averigua se a conta já estava armazenada no cookie (ou seja, a pessoa fez login mas não deu logoff).
		Se já existir cookie com esses valores, inicia sessão com o valor das variáveis armazenadas. Se não tiver, retorna true e armazena o valor das variáveis

		#Se existe saída antes da chamada dessa função, setcookie() irá falhar e retornará FALSE. Se a função setcookie() for executada com sucesso, ela retornará TRUE. Isso não indica que o usuário aceitou o cookie.

		http://php.net/manual/pt_BR/function.setcookie.php
		http://php.net/manual/pt_BR/function.setrawcookie.php
		*/

		session_start(); #inicia sessão

		#para pegar o valor de perfil determinado no db:
		$resultado = pg_query("SELECT perfil FROM usuarios WHERE email = '$email' AND senha = '$senhaCript'") or die("Query failed: ".pg_last_error()); #pega todos os valores de 'perfil' que condiz com o email e senha de login
		while ($linha = pg_fetch_array($resultado)) {
			$perfil = $linha['perfil']; #atribui a $perfil as linhas que satisfazem a condição do $linha (no caso os perfis correspondentes)
		}
		
		#atribuição das variáveis de sessão:
		$_SESSION['email'] = $email;
		$_SESSION['senha'] = $senhaCript;
		$_SESSION['perfil'] = $perfil;

		//CASO NÃO TENHA PERFIL:
		if ($_SESSION['perfil'] == null) {
			echo "
				<script>
					alert('Houve algum erro, não existe perfil associado a sua conta!');
					parent.location = 'login.html';
				</script>";
			unset($_SESSION['email']);
			unset($_SESSION['senha']);
			unset($_SESSION['perfil']);
		//SE TIVER PERFIL:
		} else {
			echo "
				<script>
					alert('Usuário ".$_SESSION['email']." logado com sucesso! A sessão é ".$_SESSION['perfil']."');
				</script>";
				//parent.location = 'perfil.php'; NÃO deve ser colocado aqui, pq ainda não passou o if

			//INÍCIO COOKIE
			//CHECAGEM SE TEM COOKIE ATIVO:
			if (count($_COOKIE)>1) { #se o array de COOKIES existir, será > 1
				#OBS: o localhost já cria um próprio cookie dele, por isso o cookie é > 1 e não > 0
				echo "
					<script>
						alert('Cookies habilitados! O cookie é ".$_COOKIE['email']."');
					</script>";
				//verifica se os cookies batem com o usuario, senha e perfis atuais:

				//se bater, continua, se não bater, msg de erro e logoff

				//pesquisar como um cookie é criado (pra saber da segurança dele!!)
				//pesquisar se quem armazena o cookie é somente o domínio ao qual estamos tendo acesso
				//se esse for o caso, então só precisa armazenar o email no cookie, não precisa nem da senha nem do perfil
				//pesquisar isso pra confirmar q só precisa do email

				if ($_COOKIE['email']==$_SESSION['email']) {
					echo "
					<script>
						alert('O cookie deu certo! Tá logado ainda');
					</script>";
					echo 'oi';
				} else { //se o cookie não bater com o email logado
					echo "
					<script>
						alert('Deu algum erro, o cookie não corresponde ao dados desse usuário no db!');
					</script>";
					unset($_SESSION['email']);
					unset($_SESSION['senha']);
					unset($_SESSION['perfil']);
					//setcookie('email','',time()-3600); #deleta cookie
					echo "
					 	<script>
					 		parent.location = 'perfil.php';
					 	</script>";
				}
			//SE NÃO TIVER COOKIE ATIVO:
			} else { #se ele não tiver sido criado ainda, ou seja, o usuário ainda não tinha feito login nesse pc
				//já que ele nao foi habilitado, deve ser feito um cookie que guarde as infos do usuario aqui e a sessão é criada
				echo "
					<script>
						alert('Cookies desabilitados!');
					</script>";
				#setcookie("name","value","expiration");
				setcookie('email',$email,time()+2592000); #time: 1 mês (30 dias)
			}
			//FIM COOKIE

			#redireciona para o tratamento de perfil
			echo "
				<script>
					parent.location = 'perfil.php';
				</script>";
		}
	} else { #se for false, o login e a senha não batem
		echo "
		 	<script>
		 		alert('Preencha corretamente os campos!');
		 		parent.location = 'login.html';
		 	</script>";
	}

	pg_close($conexao);	#fecha a conexão
?>