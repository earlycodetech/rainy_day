<?php 
 include_once 'db_con.php';
 include "../includes/sessions.php";
 require 'php-rest-api-master/autoload.php';

 if (!isset($_POST['send'])) {
    header("Location: ../../user/dashboard");
 }else{
    $userMessage = $_POST['message'];

    $MessageBird = new \MessageBird\Client('Gn9DHxQeu8fNlJkXv8a2i6kdN');
    $Message = new \MessageBird\Objects\Message();
    $Message->originator = 'Rainy Day';
    $Message->recipients = array("+2348142237388");
    $Message->body = $userMessage;

    if ($MessageBird->messages->create($Message)) {
        $_SESSION['successmessage'] =  "SMS was sent succeffully";
        header("Location: ../../user/contact");
    }else{
        $_SESSION['errormessage'] =  "SMS not sent";
        header("Location: ../../user/contact");
    };
 }