<?php
    $host = "localhost";
    $user = "root";
    $userPassword = "";
    $dbName = "rainy_day";

    $connectDB = mysqli_connect($host,$user,$userPassword,$dbName);

    if (!$connectDB) {
        die("Something went wrong".mysqli_connect_error());
    }
    // If Databas connection fails