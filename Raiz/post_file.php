<?php

#PASSAR A LOCALIZAÇÃO E O NOME DO ARQUIVO DE UPLOAD VIA SESSÃO
session_start();
// If you want to ignore the uploaded files, 
// set $demo_mode to true;

$demo_mode = false;
$upload_dir = 'uploads/';
$allowed_ext = array('jpg','jpeg','png','gif');


if(strtolower($_SERVER['REQUEST_METHOD']) != 'post'){
	exit_status('Error! Wrong HTTP method!');
}


if(array_key_exists('pic',$_FILES) && $_FILES['pic']['error'] == 0 ){
	
	$pic = $_FILES['pic'];

	if(!in_array(get_extension($pic['name']),$allowed_ext)){
		exit_status('Apenas os formatos '.implode(',',$allowed_ext).' são permitidos!');
	}	

	if($demo_mode){
		
		// File uploads are ignored. We only log them.
		
		$line = implode('		', array( date('r'), $_SERVER['REMOTE_ADDR'], $pic['size'], $pic['name']));
		file_put_contents('log.txt', $line.PHP_EOL, FILE_APPEND);
		
		exit_status('Uploads are ignored in demo mode.');
	}
	
	
	// Move the uploaded file from the temporary 
	// directory to the uploads folder:
	
	if(move_uploaded_file($pic['tmp_name'], $upload_dir.$pic['name'])){
		$_SESSION['nomefoto'] = $pic['name'];
		$_SESSION['localfoto'] = $upload_dir;
		exit_status('Upload de arquivos realizado com sucesso.');
	}
	
}

exit_status('Alguma coisa deu errado no seu upload!');


// Helper functions

function exit_status($str){
	echo json_encode(array('status'=>$str));
	exit;
}

function get_extension($file_name){
	$ext = explode('.', $file_name);
	$ext = array_pop($ext);
	return strtolower($ext);
}
?>