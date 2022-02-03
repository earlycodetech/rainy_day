<?php
    include_once 'db_con.php';
    include "../includes/sessions.php";

    date_default_timezone_set("Africa/Lagos");

    if (!isset($_POST['register'])) {
        header("Location: ../../register.php");
    }else{
        // If button is set collect data

        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $userId = "RD".rand(1000000,9999999);
        $email = $_POST['email'];
        $phone = $_POST['phoneNumber'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $confirm = $_POST['cPassword'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $department = $_POST['department'];
        $date = date("Y-m-d h:i:s");
        

        if (strlen($_POST['password']) < 8) {
            $_SESSION['errormessage'] =  "Password too short";
            header("Location: ../../register.php");
        }
        elseif ($_POST['password'] != $confirm ) {
            $_SESSION['errormessage'] =  "Passwords do not match";
            header("Location: ../../register");
        }
        // elseif(){

        // }
        else{
            $sql = "INSERT INTO users(userid,first_name,last_name,email,phone,password,dob,gender,department,date_created) VALUES(?,?,?,?,?,?,?,?,?,?)";
            // Initialize Database Connection
            $stmt = mysqli_stmt_init($connectDB);
            // Prepare SQL statement
            mysqli_stmt_prepare($stmt,$sql);
            // Bind parameters to the placeholder
            mysqli_stmt_bind_param($stmt,"ssssssssss",$userId,$firstName,$lastName,$email,$phone,$password,$dob,$gender,$department,$date);
            // Execute statement
           if (mysqli_stmt_execute($stmt)) {
            $_SESSION['successmessage'] =  "Registeration was successful, Please go ahead and log in";
            header("Location: ../../register");
           }else{
                $_SESSION['errormessage'] =  "Something went wrong";
                header("Location: ../../register");
           }
        }
    }