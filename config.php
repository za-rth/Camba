<?php

$host = 'localhost';
$username = 'root';
$password = '';
$database = 'cambawebsite';


$connection = new mysqli($host,$username,$password,$database);

if($connection -> connect_error){
    die("Error, Connection failed");
}else{
    echo "Connection Success";
}