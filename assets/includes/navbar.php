<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/fontawsome/css/all.css">
</head>
<body style="background-image: url(../assets/img/bg-1.jpg); background-size: cover; background-position: top; height: 100vh; background-repeat: no-repeat;">
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Rainy Day</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="dashboard">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="settings">Profile</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="withdrawal">Withrawal</a>
        </li>
        <?php if($_SESSION['role'] === 'admin'){ ?>
          <li class="nav-item">
          <a class="nav-link active" aria-current="page" target="_blank" href="set-amount">Gross Amount</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" target="_blank" href="requests">Withdrawal Requests</a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="../assets/config/logout.php">Logout</a>
        </li>
        
      </ul>
      
    </div>
  </div>
</nav>