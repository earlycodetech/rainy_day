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

<?php 
    if (!isset($_GET['qs'])) {
        header("Location: dashboard");
    }else{
        $param = $_GET['qs'];
        $sql = "SELECT * FROM users WHERE userid = '$param'";
        $query = mysqli_query($connectDB,$sql);

        $check = mysqli_num_rows($query);
        if ($check < 1) {
            $_SESSION['errormessage'] =  "User ID does not exist";
            header("Location: dashboard");
        }else{
            $row = mysqli_fetch_assoc($query);
    
?>
<section>
    <div class="container mt-4">
        <form action="" method="POST">
            <div class="card shadow-lg py-5 px-3 bg-dark bg-gradient">
                <div class="row text-light ">
                    <div class="col-md-4 mb-3">
                        <label>First Name</label>
                        <input type="text" placeholder="<?php echo $row['first_name']; ?>" name="fname" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Last Name</label>
                        <input type="text" placeholder="<?php echo $row['last_name']; ?>" name="lname" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Email</label>
                        <input type="text" value="<?php echo $row['email']; ?>" class="form-control" readonly>
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Phone</label>
                        <input type="text" placeholder="<?php echo $row['phone']; ?>" name="fname" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Date of Birth</label>
                        <input type="text" onfocus="(this.type='date')" placeholder="<?php echo $row['dob']; ?>" name="fname" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Gender</label>
                        <input type="text" placeholder="<?php echo $row['gender']; ?>" name="fname" class="form-control">
                    </div>

                    <div class="col-md-4 mb-3">
                        <label>Department</label>
                        <input type="text" placeholder="<?php echo $row['department']; ?>" name="fname" class="form-control">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label>Date of registeration</label>
                        <input type="text" value="<?php echo $row['date_created']; ?>" name="fname" class="form-control" readonly>
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php } } ?>
</body>
</html>