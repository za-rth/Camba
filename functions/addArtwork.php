<?php

include 'config.php';


if ($_SERVER['REQUEST_METHOD'] == 'POST' &&  isset($_POST['submit'])){
    if (empty($_POST['ArtTitle']) || empty($_POST['ArtDescription'])||empty($_POST['size'])||empty($_POST['year'])) {
        echo "<script>alert('Please FIll in Descriptions')</script>";
    }
    else{
        $sql=$connection->prepare("SELECT `ARTWORK_ID`, `TITLE`, `DESCRIPTION`, `QTYONHAND`, `UNITPRICE`, `IMG_NAME`, `USER_ID`, `LAST_UPDATE` FROM `artwork_product_info`");
    }
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (
        empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['birthDate'])
        || empty($_POST['nationality']) || empty($_POST['country']) || empty($_POST['state'])
        || empty($_POST['zipCode']) || empty($_POST['gender']) || empty($_POST['usertype']) 
        ) {
        // Handle error, e.g., display an error message
        echo "<script>alert('Please fill in all required fields.')</script>";
  
    }else{
        
       
        $sql = $connection->prepare("INSERT INTO `user_profile_registration` (`FIRSTNAME`, `LASTNAME`, `BIRTHDATE`, `NATIONALITY`, `COUNTRY`, `STATE`, `ZIP_CODE`,`GENDER`, `USER_TYPE`, `EMAIL`, `PASSPHRASE`,`DATE_CREATED`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,NOW())");
        $sql->bind_param("ssssssissss", $firstname, $lastname, $birthdate, $nationality, $country, $state, $zipcode, $gender, $usertype, $email, $password);
        $sql->execute();
        echo "<script>alert('Account Created')</script>";
    
        
        $sql->close();
    }
   
    
}