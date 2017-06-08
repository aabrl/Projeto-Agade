<?php
	//CHECAGEM SE TEM COOKIE ATIVO OU NÃO
	if (count($_COOKIE)>0) { #se o array de COOKIES existir, será > 0
		echo 'cookies habilitados<br>';
		echo $_COOKIE['teste'];

		//se ele existir, então a sessão é criada

	} else { #se ele não tiver sido criado ainda, ou seja, o usuário ainda não fez login

		//já que ele nao foi habilitado, deve ser feito um cookie que guarde as infos do usuario aqui e a sessão é criada

		echo 'cookies não habilitados';
		#setcookie("name","value","expiration");
		setcookie('teste','texto do teste 1',time()+180); //data com ou sem aspas

	}

?>