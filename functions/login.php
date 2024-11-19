<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if (empty($_POST['email']) || empty($_POST['password'])){
       
        echo "Please fill in all required fields.";
        exit;
            
        
    }
 
    $email = $_POST['email'];
    $password = $_POST['passwordKey'];
    
    $sql = $connection->prepare("SELECT EMAIL PASSWORD FROM `user_account` WHERE `EMAIL` = ? AND `PASSWORD` = ?"  );
    $sql->bind_param("ss",$email,$password);
    $sql->execute();

    if($result  ){

    }
    header('homepage');
    $sql->close();
  
}

