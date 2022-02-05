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

                <div class="card w-25 mx-auto bg-primary text-light mb-4 bg-gradient shadow-lg p-3">
                    <h5 class="fw-light">Gross Amount: ₦ 25,000,000.00</h5>
                    <h5 class="fw-light">WHT: 5%</h5>
                    <h5 class="fw-light">VAT: 7.5%</h5>
                    <h5 class="fw-light">SPD: 1%</h5>
                    <h5 class="fw-light">NET: ₦ </h5>
                </div>
                <input type="text" name="dept" placeholder="Enter Withdrawal Amount" class="form-control mb-3">

                <input type="submit" name="withraw" value="Withdraw" class="btn btn-primary">
            </form>
        </div>
    </div>
</section>
</body>
</html>