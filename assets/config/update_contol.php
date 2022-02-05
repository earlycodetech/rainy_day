<?php
    include_once 'db_con.php';
    include "../includes/sessions.php";
    $id = $_SESSION['id'];

   
    if(isset($_POST['update'])){
        $fname= $_POST['fname'];
        $lname= $_POST['lname'];
        $phone= $_POST['phone'];
        $gender= $_POST['gender'];
        $dept= $_POST['dept'];

       if (!empty($fname)) {
            $sql = "UPDATE users SET first_name = '$fname' WHERE id = '$id'";
            $query = mysqli_query($connectDB,$sql);
            if ($query) {
                $_SESSION['successmessage'] =  "Update was successfull";
                header("Location: ../../user/settings");
            }else{
                $_SESSION['errormessage'] =  "Update failed";
                header("Location: ../../user/settings");
            }
       }
       if (!empty($lname)) {
        $sql = "UPDATE users SET last_name = '$lname' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['successmessage'] =  "Update was successfull";
            header("Location: ../../user/settings");
        }else{
            $_SESSION['errormessage'] =  "Update failed";
            header("Location: ../../user/settings");
        }
       }
       if (!empty($phone)) {
        $sql = "UPDATE users SET phone = '$phone' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['successmessage'] =  "Update was successfull";
            header("Location: ../../user/settings");
        }else{
            $_SESSION['errormessage'] =  "Update failed";
            header("Location: ../../user/settings");
        }
       }
       if (!empty($gender)) {
        $sql = "UPDATE users SET gender = '$gender' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['successmessage'] =  "Update was successfull";
            header("Location: ../../user/settings");
        }else{
            $_SESSION['errormessage'] =  "Update failed";
            header("Location: ../../user/settings");
        }
       }
       if (!empty($dept)) {
        $sql = "UPDATE users SET department = '$dept' WHERE id = '$id'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            $_SESSION['successmessage'] =  "Update was successfull";
            header("Location: ../../user/settings");
        }else{
            $_SESSION['errormessage'] =  "Update failed";
            header("Location: ../../user/settings");
        }
       }
    }


    // CONTROL TO ADD GROSS AMOUNT
    elseif (isset($_POST['add'])) {
       $amount = $_POST['amount'];
        $date = date('Y-m-d h:i:s');

        $sql ="SELECT * FROM total_amount WHERE id = '1'";
        $query = mysqli_query($connectDB,$sql);
        $row = mysqli_fetch_assoc($query);
        $total = $row['amount'];

        $newTotal = $amount + $total;
       $sql = "INSERT INTO gross(amount_added,total_amount,date_created) VALUES(?,?,?)";
            // Initialize Database Connection
            $stmt = mysqli_stmt_init($connectDB);
            // Prepare SQL statement
            mysqli_stmt_prepare($stmt,$sql);
            // Bind parameters to the placeholder
            mysqli_stmt_bind_param($stmt,"sss",$amount,$newTotal,$date);
            // Execute statement
           if (mysqli_stmt_execute($stmt)) {

            $sql = "UPDATE total_amount SET amount= '$newTotal' WHERE id= '1'";
            $query = mysqli_query($connectDB,$sql);
            if ($query) {
                $_SESSION['successmessage'] =  "New gross amount added";
                header("Location: ../../user/set-amount");
            }else{
                $_SESSION['errormessage'] =  "Failed to update total amount";
                header("Location: ../../user/set-amount");
            }
           
           }else{
                $_SESSION['errormessage'] =  "Something went wrong";
                header("Location: ../../user/set-amount");
           }
    }
    
    else {
        header("Location: ../../user/dashboard");
    }