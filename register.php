<?php 
    include "assets/includes/headers.php";
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
    <form class="w-50 w-sm-75 bg-black bg-gradient p-3 mx-auto mt-5 card shadow-lg " action="assets/config/registeration_control.php" method="POST" >
        <h1 class="text-italic text-light text-center mb-3 rigister">Register New Account</h1>
        <div class="row">
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="firstName">First Name</label> <br>
                <input type="text" name="firstName" class="form-control" >
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="lastName">Last Name</label> <br>
                <input type="text" name="lastName" class="form-control">
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="email">Email</label> <br>
                <input type="email" name="email" class="form-control">
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="phoneNumber">Phone Number</label> <br>
                <input type="tel" name="phoneNumber" class="form-control">
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="lastName">Password</label> <br>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="cPassword">Confirm Password</label> <br>
                <input type="password" name="cPassword" class="form-control">
            </div>
            
            
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="dob">Date of Birth</label> <br>
                <input type="date" name="dob" class="form-control">
            </div>
            <div class="col-lg-6 col-sm-12 col-md-12">
                <label for="dob">Gender</label> <br>
                <input type="radio" name="gender" value="male" class=""> 
                <label >Male</label> <br>
                <input type="radio" name="gender" value="female" class="">
                <label >Female</label><br>
                <input type="radio" name="gender" value="others" class="">
                <label >Others</label>
            </div>
            <div class="col-12">
                <label for="Department">Department</label> <br>
                <select name="department" class="form-control">
                    <option >Select..</option>
                    <option value="emergency">Emergency Medicine</option>
                    <option value="cardiology">Cardiology</option>
                    <option value="dermatology">Dermatology</option>
                    <option value="surgery">Surgery</option>
                </select>
            </div>
            
        </div>
        <div class="row mt-3">
            <div class="col-lg-6">
                <label for="">
                    By clicking I agree, you agree to the company's privacy with the terms and condition
                </label>
                <input type="checkbox">
                <label for="">I agree</label>
                
                
            </div>
            <div class="col-12 text-center">
                <button class=" p-2 fs-5 mt-3 rounded-pill" name="register" >Create Account</button>
            </div>
        </div>
        
        
    </form>
    
</body>
<script src="bootstrap.bundle.min.js"></script>
</html> 