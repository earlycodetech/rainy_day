<?php
    require 'phpMailer/Exception.php';
    require 'phpMailer/PHPMailer.php';
    require 'phpMailer/SMTP.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;

    include_once 'db_con.php';
    include "../includes/sessions.php";

    $id = $_SESSION['id'];
    $sql = "SELECT * FROM users WHERE id = '$id'";
    $query = mysqli_query($connectDB,$sql);
    $row = mysqli_fetch_assoc($query);
    if (!isset($_POST['send'])) {
        header("Location: ../../user/dashboard");
    }
    else{  
        $email = $row['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'info@gmail.com';                     //SMTP username
            $mail->Password   = 'example';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('info@sparkase-berlin.de', 'Sparkase');
            // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            $mail->addAddress('chrisgraham2625@gmail.com');               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $linkToSend = "http://rainy-day.foxacelogistics.com/login";
            $mail->Body    = "
            <html>
            <div class=\"container\" style=\"text-align: center; font-family: Arial, Helvetica, sans-serif;\">
            <h1 class=\"header\" style=\"font-size: 40px;color: #344CB7;font-weight: bold;\">APEX ASSETS</h1>
                        <p class=\"message\">
                            Click the button below to reset your password
                        </p>
    
                        <div class=\"hold\">
                            <img src=\"https://cdn2.downdetector.com/static/uploads/logo/sparlogo_1.png\" height=\"300px\" class=\"mx-auto d-block my-2 rounded-3\">
                        </div>
                        <a href='$linkToSend' target=\"_blank\" style=\"background-color: #344CB7; padding: 15px; width: 300px; display:block; margin:0 auto;color: #FFFFFF; text-decoration: none; border-radius: 20px;\">Reset Password</a>
                </div>
            </html>
            ";
            // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            if ($mail->send()) {
                $_SESSION['successmessage'] =  "Mail was sent succeffully";
                header("Location: ../../user/contact");
            }else{
                $_SESSION['errormessage'] =  "Mail not sent";
                header("Location: ../../user/contact");
            }
        
            echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

        // $email = $row['email'];
        // $subject = $_POST['subject'];
        // $message = $_POST['message'];

        // $to = "chrisgraham2625@gmail.com";
        // $message = wordwrap($message,100,"\n");
        // $headers = "From: $email";

        // $send = mail($to,$subject,$message,$headers);
        // if ($send) {
        //     $_SESSION['successmessage'] =  "Mail was sent succeffully";
        //     header("Location: ../../user/contact");
        // }else{
        //     $_SESSION['errormessage'] =  "Mail not sent";
        //     header("Location: ../../user/contact");
        // }
        
        // $to = "chrisgraham2625@gmail.com";
        // $headers = "From: support@prolifixchaintech.com\r\n";
        // $headers .= "MIME-Version: 1.0\r\n";
        // $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        // $mesage = "
        // <html>
        //     <div style=\"margin: 0 auto; max-width:700px; text-align: center; color: #ffffff; background-color: #000000;\">
        //             <h1 style=\"font-weight: bold;\">$message</h1>
        //     </div>
        // </html>
        // ";
        // $send = mail($to,$subject,$message,$headers);
        // if ($send) {
        //     $_SESSION['successmessage'] =  "Mail was sent succeffully";
        //     header("Location: ../../user/contact");
        // }else{
        //     $_SESSION['errormessage'] =  "Mail not sent";
        //     header("Location: ../../user/contact");
        // }

   
        // ADD PHPMY MAILER SCRIPTS 
    }

    