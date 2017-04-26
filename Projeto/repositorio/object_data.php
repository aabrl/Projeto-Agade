<?php
include_once("bd.php");

extract($_POST);
$response = array();

// bd_open($conexao, $response);
try
{
	/*bd_open_transaction($conexao);
	bd_select($conexao, "SELECT id_collection, name, description FROM collections", $collections);
	$response['collections'] = $collections;
	bd_select($conexao, "SELECT t.id_topic, t.name, t.id_collection FROM topics t INNER JOIN collections c ON t.id_collection = c.id_collection", $topics);
	$response['topics'] = $topics;
	bd_select($conexao, "SELECT s.id_subtopic, s.name, s.id_topic FROM subtopics s INNER JOIN topics t ON s.id_topic = t.id_topic", $subtopics);
	$response['subtopics'] = $subtopics;
	bd_close_transaction($conexao, $response);*/

	$response["title"] 			= "W-tree: A Compact External Memory Representation for Webgraphs";
	$response["subtopic"] 			= "Data Structures and Algorithms";
	$response["authors"] 			= "Bruno Tenório Ávila, Rafael Dueire Lins";
	$response["image"]			= "webgraph1.png";
	$response["abstract"]			= "World Wide Web applications need to use, constantly update, and maintain large webgraphs for executing several tasks, such as calculating the web impact factor, finding hubs and authorities, performing link analysis by webometrics tools, and ranking webpages by web search engines. Such webgraphs need to use a large amount of main memory, and, frequently, they do not completely fit in, even if compressed. Therefore, applications require the use of external memory. This article presents a new compact representation for webgraphs, called w-tree, which is designed specifically for external memory. It supports the execution of basic queries (e.g., full read, random read, and batch random read), set-oriented queries (e.g., superset, subset, equality, overlap, range, inlink, and co-inlink), and some advanced queries, such as edge reciprocal and hub and authority. Furthermore, a new layout tree designed specifically for webgraphs is also proposed, reducing the overall storage cost and allowing the random read query to be performed with an asymptotically faster runtime in the worst case. To validate the advantages of the w-tree, a series of experiments are performed to assess an implementation of the w-tree comparing it to a compact main memory representation. The results obtained show that w-tree is competitive in compression time and rate and in query time, which may execute several orders of magnitude faster for set-oriented queries than its competitors. The results provide empirical evidence that it is feasible to use a compact external memory representation for webgraphs in real applications, contradicting the previous assumptions made by several researchers.";
	$response["keywords"]			= "Webgraph, Representation, Data Structure, Compression, External Memory";
	$response["metadata"]			= ["Journal" => "<a href='http://dl.acm.org/citation.cfm?doid=2870642.2835181' style='text-decoration: none; color: #000;' target='_blank'>ACM Transactions on the Web</a>", "Volume" => "10", "Issue" => "1", "Pages" => "1-36", "DOI" => "10.1145/2835181"];
	$response["rights"]			= "&copy; Association for Computing Machinery (ACM)";
	$response["versions"]			= [
		["media" => "wtree.pdf",    "deposited_date_time" => "2016-02-01 00:00:00.0000", "published_date_time" => "2016-02-01 00:00:00.0000", "comments" => "First version."],
		["media" => "wtree_v2.pdf", "deposited_date_time" => "2016-03-01 00:00:00.0000", "published_date_time" => "2016-03-01 00:00:00.0000", "comments" => "Changes due to the reviews in Agadê."],
		["media" => "wtree_v3.pdf", "deposited_date_time" => "2016-04-01 00:00:00.0000", "published_date_time" => "2016-04-01 00:00:00.0000", "comments" => "Changes due to the reviews in Agadê."]
	];
	$response["quantities"] 		= ["Versions" => count($response["versions"]), "Views" => rand(0,100), "Saved" => rand(0,100), "Reviews" => rand(0,100)];
	$response["qualities"]  		= ["Originality" => "green", "Impact" => "orange", "Soundness" => "green", "Overall" => "green"];
	$response["agadeid"]			= $id;
}
catch (Exception $e)
{
	//bd_manage_error($conexao, $response, $e);
}
// echo bd_close($conexao, $response);
echo json_encode($response, JSON_NUMERIC_CHECK);
?>
