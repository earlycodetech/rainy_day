<?php
     include "../assets/includes/sessions.php";
     include "../assets/config/db_con.php";

     auth();

     $id = $_SESSION['id'];

     $sql = "SELECT * FROM users WHERE id= '$id'";
     $query = mysqli_query($connectDB,$sql);
     $row =  mysqli_fetch_assoc($query);

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
            <form action="../assets/config/update_contol.php" method="post">
                <?php 
                     $sql = "SELECT * FROM total_amount  ORDER BY id DESC LIMIT 1";
                     $query = mysqli_query($connectDB,$sql);
                    
                    while( $row  = mysqli_fetch_assoc($query)){
                ?>
                <h1 class="fw-light">₦ <?php  echo number_format($row['amount'],2,'.',','); ?></h1>
                <?php } ?>
                <input type="text" name="amount" placeholder="Enter amount to add" class="form-control mb-3">

                <input type="submit" name="add" value="Add" class="btn btn-primary">
            </form>
        </div>

        <div class="table-responsive container">
        <table class="table text-light table-dark">
            <thead>
              <tr>
                <th scope="col">Date</th>
                <th scope="col">Amount</th>
                <th scope="col">Total Amount</th>
              </tr>
            </thead>
            <tbody>
            <?php  
              $sql = "SELECT * FROM gross  ORDER BY id DESC";
              $query = mysqli_query($connectDB,$sql);
             
             while( $row = mysqli_fetch_assoc($query)){
            ?>
              <tr>
                <td><?php echo $row['date_created']; ?></td>
                <td>₦ <?php echo  number_format($row['amount_added'],2,'.',','); ?></td>
                <td>₦ <?php echo  number_format($row['total_amount'],2,'.',','); ?></td>
              </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
    </div>
</section>
</body>
</html>