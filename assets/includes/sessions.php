<?php 
    session_start();

    function errorMessage(){
        if (isset($_SESSION['errormessage'])) {
           $message = "<div class=\"alert text-center fw-bold alert-danger\" role=\"alert\">";
           $message .= htmlentities($_SESSION['errormessage']);
           $message .= "</div>";

           $_SESSION['errormessage'] = null;
           return $message;
        }
    }

    function successMessage(){
        if (isset($_SESSION['successmessage'])) {
            $message = "<div class=\"alert text-center fw-bold alert-success\" role=\"alert\">";
            $message .= htmlentities($_SESSION['successmessage']);
            $message .= "</div>";

            $_SESSION['successmessage'] = null;
            return $message;
         }
    }

    function auth(){
        if (!isset($_SESSION['id'])) {
            header("Location: ../login.php");
         }
    }
