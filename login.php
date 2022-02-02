<?php 
    include "assets/includes/headers.php";
    include "assets/includes/sessions.php";
?>
<style>
    label{
        color: wheat;
        font-size: 20px;
        
    }
    input:focus,select{
        box-shadow: none !important;
        border: none;
    }
    input[type='radio']{
        width: 20px;
        height: 20px;
    }
    button{
        background-image: linear-gradient(gold,black,goldenrod);
        color: azure;
        width: max-content;
    }
    .rigister{
        color: azure !important;
    }
    
    @media only screen and (max-width:640px) {
        label,button{
            font-size: 15px !important;
        }
        input{
            margin-bottom: 15px !important;
        }
        
    }
    
</style>
<body>

    <form class="w-50 w-sm-75 bg-black bg-gradient p-3 mx-auto mt-5 card shadow-lg " action="assets/config/login_control.php" method="POST" >]
    <?php echo errorMessage(); echo successMessage(); ?>
        <h1 class="text-italic text-light text-center mb-3 rigister">Welcome Please Log In</h1>
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="firstName">Email:</label> <br>
                <input type="text" name="email" class="form-control" >
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="lastName">Password</label> <br>
                <input type="text" name="password" class="form-control">
            </div>
         
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <button class=" p-2 px-5 fs-5 mt-3 rounded-pill" name="login" >Log In</button>
            </div>
        </div>
        
        
    </form>
    
</body>
<script src="bootstrap.bundle.min.js"></script>
</html> 