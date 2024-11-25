<?php
include 'config.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    if (isset($_POST['login'])) {


        if (empty($email) && empty($password)) {
            echo "<script>alert('Insert valid Credentials')</script>";

            exit;
        } else {
            $sql = $connection->prepare("SELECT EMAIL FROM `user_account` WHERE `EMAIL` = ? AND `PASSWORD` = ?");
            $sql->bind_param("ss", $email, $password);
            $sql->execute();
            echo "<script>alert('Login Successful')</script>";
            header("Location: buyerPage.php");
            $sql->close();
        }


    }
    session_unset();
    session_destroy();


}

