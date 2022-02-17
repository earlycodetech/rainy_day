<?php
     include "../assets/includes/sessions.php";
     include "../assets/config/db_con.php";

     auth();

     $id = $_SESSION['id'];

     $sql = "SELECT * FROM users WHERE id= '$id'";
     $query = mysqli_query($connectDB,$sql);
     $row =  mysqli_fetch_assoc($query);
     $uid = $row['userid'];

    include '../assets/includes/navbar.php';
      $userIP = $_SERVER['REMOTE_ADDR'];
      // $userIP = "102.222.198.75";
      // API end URL 
      $apiURL = 'https://freegeoip.app/json/'.$userIP; 
      
      // Create a new cURL resource with URL 
      $ch = curl_init($apiURL); 
      
      // Return response instead of outputting 
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
      
      // Execute API request 
      $apiResponse = curl_exec($ch); 
      
      // Close cURL resource 
      curl_close($ch); 
      
      // Retrieve IP data from API response 
      $ipData = json_decode($apiResponse, true); 
      print_r($ipData);
      if(!empty($ipData)){ 
          $country_name = $ipData['country_name'].", ".$ipData['city']; 
          $zip_code = $ipData['zip_code']; 
      }else{ 
          echo 'IP data is not found!'; 
      } 
?>

<section>
  <div class="container pt-3">
      <div class="row">
        <div class="col-md-3">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-user"></i> USER NAME</h4>
              <h5 class="text-end mt-3"><?php echo $row['first_name']." ".$row['last_name']; ?></h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-calendar"></i> DEPARTMENT</h4>
              <h5 class="text-end mt-3"><?php echo $row['department']; ?></h5>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-envelope"></i> EMAIL</h4>
              <h5 class="text-end mt-3"><?php echo $row['email']; ?></h5>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-envelope"></i> Withdrwal</h4>
              <h5 class="text-end mt-3">₦ <?php echo number_format($row['total_withdrawal'],2,'.',','); ?></h5>
            </div>
        </div>
      </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <?php echo errorMessage(); echo successMessage(); ?>
        
        <div class="card p-2 mx-auto" style="max-width: 700px;">
        <h1 class="text-center">
            SEND Email
          </h1>
        <form action="../assets/config/mail_control.php" method="post">
            <input type="text" name="subject" placeholder="Subject*" class="form-control my-2">
            <textarea name="message" class="form-control my-2" style="height: 300px;"></textarea>

            <div class="text-end">
                <button type="submit" name="send" class="btn btn-primary btn-lg">Send</button>
            </div>
        </form>
<hr>
        <form action="../assets/config/text_control.php" method="post">
          <h1 class="text-center">
            SEND TEXT MESSAGE
          </h1>
          <textarea name="message" class="form-control my-2" style="height: 300px;"></textarea>
          <button type="submit" name="send" class="btn btn-primary btn-lg">Send Text</button>
        </form>
        </div>
       
    </div>
</section>

<script src="../assets/js/withdrawal.js"></script>
</body>
</html>