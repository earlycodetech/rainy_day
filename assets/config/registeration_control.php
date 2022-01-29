<?php
    include_once 'db_con.php';


    if (!isset($_POST['register'])) {
        header("Location: ../../register.php");
    }else{
        // If button is set collect data

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phoneNumber'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $confirm = $_POST['cPassword'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];

        if (strlen($_POST['password']) < 8) {
            echo "Password too short";
        }
        elseif ($_POST['password'] != $confirm ) {
           echo "Passwords do not match";
        }
        else{

        }
    }