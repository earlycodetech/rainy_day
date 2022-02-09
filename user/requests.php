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
        <div class="card shadow-lg p-3">
            <div class="table-responsive container">
                <table class="table text-light table-dark">
                    <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Full Name</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Status</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  
                    $sql = "SELECT * FROM withdrawals ORDER BY id DESC";
                    $query = mysqli_query($connectDB,$sql);
                    
                    while( $row = mysqli_fetch_assoc($query)){
                    ?>
                    <tr>
                        <td><?php echo $row['date_created']; ?></td>
                        <td><?php echo $row['full_name']; ?></td>
                        <td>₦ <?php echo  number_format($row['amount'],2,'.',','); ?></td>
                        <td><?php echo  $row['withdrawal_status']; ?></td>
                        <td>
                            <?php 
                                if ($row['withdrawal_status'] == 'successful') {
                                   echo "<i class=\"fas fa-thumbs-up\"></i>";
                                }else{
                                    $wid = $row['id'];
                                   echo "<a href=\"../assets/config/update_contol?confirm=$wid\" class=\"btn btn-primary\"><i class=\"fas fa-check\"></i></a>";
                                }
                            ?>
                        </td>
                    </tr>

                    <?php } ?>
                    </tbody>
                </table>
            </div> 
        </div>

       
    </div>
</section>

<script src="../assets/js/withdrawal.js"></script>
</body>
</html>