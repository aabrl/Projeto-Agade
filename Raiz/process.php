<?php
	$errors = array();
    $form_data = array();
 //   EXTRACT($_POST); 

    
    if (empty($_POST['email'])) {
        $errors['name'] = 'EMAIL NAO PODE FICAR EM BRANCO';
    }
   
    if (!empty($errors)) {
       	$form_data['success'] = false;
       	$form_data['errors']  = $errors;
    } else {
        $form_data['success'] = true;
        $form_data['posted'] = 'SUCESSO';
        
        include "config.php";    
        
        $email = $_POST['email'];
   //     $senha = $_POST['senha'];

        $query = "INSERT INTO usuarios(email) VALUES ('$email')";
        $result = pg_query($query) or die('Query failed: ' . pg_last_error());
        $pg_close = ($link);
    }
    echo json_encode($form_data);
?>