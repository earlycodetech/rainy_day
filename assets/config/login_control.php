<?php
    include_once 'db_con.php';
    include "../includes/sessions.php";

    if (!isset($_POST['login'])) {
        header("Location: ../../login.php");
    }
    else{
        $email = $_POST['email'];
        $password = $_POST['password'];



        $sql = "SELECT * FROM users WHERE email = ?";
        // Initialize Database Connection
        $stmt = mysqli_stmt_init($connectDB);
        // Prepare SQL statement
        mysqli_stmt_prepare($stmt,$sql);
        // Bind parameters to the placeholder
        mysqli_stmt_bind_param($stmt,"s",$email);
        $execute = mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);
            // print_r($result);
            if ($row = mysqli_fetch_assoc($result)) {
               $returnedPassword = $row['password'];

                if (password_verify($password,$returnedPassword)) {
                    $_SESSION['id'] = $row['id'];
                    $_SESSION['dept'] = $row['dept'];

                    $_SESSION['successmessage'] =  "Incorrect password";
                    header("Location: ../../user/dashboard.php");
                }else{
                    $_SESSION['errormessage'] =  "Incorrect password";
                    header("Location: ../../login.php");
                }
            }else{
                $_SESSION['errormessage'] =  "Invalid Email Address";
                header("Location: ../../login.php");
            }
            // print_r($row);
       
    }