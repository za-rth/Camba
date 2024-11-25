<?php
include 'config.php';
session_start();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['birthDate'])
        || empty($_POST['nationality']) || empty($_POST['country']) || empty($_POST['state'])
        || empty($_POST['zipCode']) || empty($_POST['gender']) || empty($_POST['usertype']) 
        ) {
        // Handle error, e.g., display an error message
        echo "<script>alert('Please fill in all required fields.')</script>";
  
    }else{
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $birthdate = $_POST['birthDate'];
        $nationality = $_POST['nationality'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $zipcode = $_POST['zipCode'];
        $gender = $_POST['gender'];
        $usertype = $_POST['usertype'];
        $email = $_POST['email'];
        $password = $_POST['passwordKey'];
       
        $sql = $connection->prepare("INSERT INTO `user_profile_registration` (`FIRSTNAME`, `LASTNAME`, `BIRTHDATE`, `NATIONALITY`, `COUNTRY`, `STATE`, `ZIP_CODE`,`GENDER`, `USER_TYPE`, `EMAIL`, `PASSPHRASE`,`DATE_CREATED`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())");
        $sql->bind_param("ssssssissss", $firstname, $lastname, $birthdate, $nationality, $country, $state, $zipcode, $gender, $usertype, $email, $password);
        $sql->execute();
        echo "<script>alert('Account Created')</script>";
    
        
        $sql->close();
    }
   
    
}
session_unset();
session_destroy();
