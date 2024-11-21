<?php
include 'config.php';

if($_SERVER['REQUEST_METHOD']=='POST'){
    
    if (isset($_POST['login'])){
        
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = $connection->prepare("SELECT EMAIL , PASSWORD FROM `user_account` WHERE `EMAIL` = ? AND `PASSWORD` = ?"  );
        $sql->bind_param("ss",$email,$password);
        $sql->execute();
        header("Location: buyerPage.php");
        $sql->close();    

    }
 
    
  
}

