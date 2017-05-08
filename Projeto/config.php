<?php
	$banco = "REPOSITORIO";
	$usuario = "postgres";
	$password = "root";
	$hostname = "127.0.0.1";

	$connbd = "host=$hostname user=$usuario password=$password dbname=$banco";
	$link = pg_connect($connbd);
?>