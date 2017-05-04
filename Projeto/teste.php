<?php
	extract($_POST);
	
	$resposta = array();
	$objetos = [["nome" => $nome, "cidade" => $cidade], ["nome" => $nome, "cidade" => $cidade]];
	$resposta['objetos'] = $objetos;
	
	echo json_encode($resposta, JSON_NUMERIC_CHECK);
?>