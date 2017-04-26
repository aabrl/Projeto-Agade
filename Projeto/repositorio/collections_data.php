<?php
include_once("bd.php");

bd_open($conexao, $response);
try
{
	bd_open_transaction($conexao);
	bd_select($conexao, "SELECT id_collection, name, description FROM collections", $collections);
	$response['collections'] = $collections;
	bd_select($conexao, "SELECT t.id_topic, t.name, t.id_collection FROM topics t INNER JOIN collections c ON t.id_collection = c.id_collection", $topics);
	$response['topics'] = $topics;
	bd_select($conexao, "SELECT s.id_subtopic, s.name, s.id_topic FROM subtopics s INNER JOIN topics t ON s.id_topic = t.id_topic", $subtopics);
	$response['subtopics'] = $subtopics;
	bd_close_transaction($conexao, $response);
}
catch (Exception $e)
{
	bd_manage_error($conexao, $response, $e);
}
echo bd_close($conexao, $response);
?>