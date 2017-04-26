<?php
	extract($_POST);
	$nome = $_POST['nome'];
	$cidade = $_POST['cidade'];
	$resposta = array();
	$objetos = ["Nome" => $nome, "Cidade" => $cidade];
	$resposta['Objetos'] = $objetos;
	echo json_encode($resposta, JSON_NUMERIC_CHECK);
?>