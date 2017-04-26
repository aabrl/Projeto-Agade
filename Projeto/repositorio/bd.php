<?php

// include_once("configuracoes.php");
// include_once("seguranca.php");

// data e hora do Recife
date_default_timezone_set('America/Recife');

function bd_open(&$conexao, &$resposta)
{
	// inicia a estrutura da resposta de volta da solicitação ajax
	$resposta = array();
	$resposta['resultado'] = false;
	$resposta['msg'] = '';
	$resposta['tempo_inicial'] = microtime(true);

	// connect
	$conexao = pg_connect("host=localhost port=5432 user=postgres password=teste1 dbname=agade") or die ("Unable to connect to database.");
	// pg_select_db("agade", $conexao);

	// usa codificação UTF-8 por padrão
	//pg_query('SET CHARACTER SET utf8');

	// timezone do Recife
	// pg_query("SET time_zone = 'America/Recife'");
}

function bd_close(&$conexao, &$resposta)
{
	if ($conexao)
	{
		@pg_close($conexao);
		$conexao = null;
	}

	$resposta['tempo_final'] = microtime(true);
	$resposta['tempo_total'] = $resposta['tempo_final'] - $resposta['tempo_inicial'];

	return json_encode($resposta, JSON_NUMERIC_CHECK);
}

function bd_check_connection(&$conexao)
{
	return pg_ping($conexao);
}

function bd_open_transaction(&$conexao)
{
	// inicia uma transação do banco
	if (!pg_query($conexao, 'BEGIN'))
		throw new Exception('erro_query');
}

function bd_close_transaction(&$conexao, &$resposta)
{
	// commit transaction
	if (!pg_query($conexao, 'COMMIT'))
		throw new Exception("erro_query");

	// se chegou aqui, então deu tudo certo
	$resposta['resultado'] = true;
}

function bd_manage_error(&$conexao, &$resposta, &$exception)
{
	switch (pg_errno($conexao))
	{
		case 1062:
			$resposta["error"] = "already_exists_error";
			break;
		case 1451:
			$resposta["error"] = "referential_integrity_error";
			break;
		default:
			$resposta["errno"] = pg_errno($conexao);
			$resposta["error"] = pg_error($conexao);
			break;
	}

	// restaura as modificações da transação
	pg_query($conexao, 'ROLLBACK');

	// coloca os erros na resposta
	$resposta['resultado'] = false;
	$resposta['msg'] = $exception->getMessage();
}

function bd_select(&$conexao, $sql, &$linhas)
{
	$consulta = pg_query($conexao, $sql);
	if ($consulta)
	{
		$linhas = array();
		while ($linha = pg_fetch_assoc($consulta))
			$linhas[] = $linha;
		return true;
	}
	else
	{
		throw new Exception("erro_query");
		return false;
	}
}

function bd_insert(&$conexao, $sql)
{
	$consulta = pg_query($conexao, $sql);
	if ($consulta)
	{
		$insert_query = pg_query($conexao, "SELECT lastval()");
		$insert_row = pg_fetch_row($insert_query);
		return $insert_row[0];
	}
	else
		throw new Exception("erro_query");
}

function bd_exec(&$conexao, $sql)
{
	$consulta = pg_query($conexao, $sql);
	if (!$consulta)
		throw new Exception("erro_query");
}

function bd_affected_rows(&$conexao)
{
	return pg_affected_rows($conexao);
}

?>
