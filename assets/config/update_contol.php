<?php
    include_once 'db_con.php';
    include "../includes/sessions.php";
    $id = $_SESSION['id'];

   $sql = "SELECT * FROM total_amount WHERE id = 1";
   $query = mysqli_query($connectDB,$sql);
   $row = mysqli_fetch_assoc($query);
   $poolBalance = $row['amount'];


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
    elseif (isset($_POST['withdraw'])) {
       $amount = $_POST['amount'];

       if ($poolBalance < $amount) {
            $_SESSION['errormessage'] =  "Insufficient Balance";
            header("Location: ../../user/withdrawal");
       }else{
           $sql = "SELECT * FROM users WHERE id = '$id'";
           $query = mysqli_query($connectDB,$sql);
           $row = mysqli_fetch_assoc($query);

           $uid = $row['userid'];
           $fullName = $row['first_name']." ".$row['last_name'];
           $status = "pending...";
           $date = date('Y-m-d h:i:s');

           $sql = "INSERT INTO withdrawals(userid,full_name,amount,withdrawal_status,date_created) VALUES(?,?,?,?,?)";
           // Initialize Database Connection
           $stmt = mysqli_stmt_init($connectDB);
           // Prepare SQL statement
           mysqli_stmt_prepare($stmt,$sql);
           // Bind parameters to the placeholder
           mysqli_stmt_bind_param($stmt,"sssss",$uid,$fullName,$amount,$status,$date);
           // Execute statement
          if (mysqli_stmt_execute($stmt)) {
           $_SESSION['successmessage'] =  "Withrawal request recieved successfully";
           header("Location: ../../user/withdrawal");
          }else{
               $_SESSION['errormessage'] =  "Something went wrong";
               header("Location: ../../user/withdrawal");
          }
       }
    }
    elseif (isset($_GET['confirm'])) {
        $wid = $_GET['confirm'];

        // Get withdrawal request
        $sql = "SELECT * FROM withdrawals WHERE id = '$wid'";
        $query = mysqli_query($connectDB,$sql);
        $row = mysqli_fetch_assoc($query);
        $uid = $row['userid'];
        $amount = $row['amount'];
        $newBalance = $poolBalance - $amount;

        // Get total withdrawal by user
        $sql = "SELECT * FROM users WHERE userid = '$uid'";
        $query = mysqli_query($connectDB,$sql);
        $row = mysqli_fetch_assoc($query);

        $withTotal = $row['total_withdrawal'];
        $newTotal = $withTotal + $amount;


        // Update pool amount
        $sql = "UPDATE total_amount SET amount = '$newBalance' WHERE id = '1'";
        $query = mysqli_query($connectDB,$sql);
        if ($query) {
            // Update withdrawal status
            $sql = "UPDATE withdrawals SET withdrawal_status = 'successful' WHERE id = '$wid'";
            $query = mysqli_query($connectDB,$sql);
            if ($query) {
                // update users total withdrawal
                $sql = "UPDATE users SET total_withdrawal = '$newTotal' WHERE userid = '$uid'";
                $query = mysqli_query($connectDB,$sql);
                if ($query) {
                    $_SESSION['successmessage'] =  "Confirmed";
                    header("Location: ../../user/requests");
                }else{
                    $_SESSION['errormessage'] =  "Something went wrong";
                    header("Location: ../../user/requests");
                }
            }else{
                $_SESSION['errormessage'] =  "Something went wrong";
                header("Location: ../../user/requests");
            }
        }else{
            $_SESSION['errormessage'] =  "Something went wrong";
            header("Location: ../../user/requests");
        }
    }
    
    else {
        header("Location: ../../user/dashboard");
    }