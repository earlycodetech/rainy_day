<?php 
 include_once 'db_con.php';
 include "../includes/sessions.php";
 require 'MessageBird/autoload.php';

 if (!isset($_POST['send'])) {
    header("Location: ../../user/dashboard");
 }else{
    $message = $_POST['message'];

    $MessageBird = new MessageBird\Client('ENTER YOUR MESSAGE BIRD LIVEAPI KEY');
    $Message = new MessageBird\Objects\Message();
    $Message->originator = 'Rainy Day';
    $Message->recipients = array("ENTER YOUR REGISTERED PHONE NUMBER");
    $Message->body = $message;

    if ($MessageBird->messages->create($Message)) {
        $_SESSION['successmessage'] =  "SMS was sent succeffully";
        header("Location: ../../user/contact");
    }else{
        $_SESSION['errormessage'] =  "SMS not sent";
        header("Location: ../../user/contact");
    };
 }