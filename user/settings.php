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
          <div class="ms-auto">
            <div class="p-2">
              <img src="../assets/img/prof_pic/<?php
                  $profPic = $row['profile_picture'];

                  if(empty($profPic)){
                      echo 'user.png';
                  }else{
                    echo "$profPic?".mt_rand();
                  }
              ?>" class="ms-auto d-block" height="100px"><?php echo "$profPic?".mt_rand(); ?>
            </div>
            <form action="../assets/config/update_contol.php" method="post" enctype="multipart/form-data">
                <input type="file" name="img" class="form-control ">
               <div class="text-end mt-3">
                  <button type="submit" name="upload" class="btn btn-primary">Upload</button>
               </div>
            </form>
          </div>
            <form action="../assets/config/update_contol.php" method="post">
                <label>First Name:</label>
                <input type="text" name="fname" placeholder="<?php echo $row['first_name']; ?>" class="form-control mb-3">
                <label>Last Name:</label>
                <input type="text" name="lname" placeholder="<?php echo $row['last_name']; ?>" class="form-control mb-3">
                <label>Email:</label>
                <input type="email"  placeholder="<?php echo $row['email']; ?>" class="form-control mb-3" readonly>
                <label>Phone:</label>
                <input type="text" name="phone" placeholder="<?php echo $row['phone']; ?>" class="form-control mb-3">
                <label>Gender:</label>
                <input type="text" name="gender" placeholder="<?php echo $row['gender']; ?>" class="form-control mb-3">
                <label>Department:</label>
                <input type="text" name="dept" placeholder="<?php echo $row['department']; ?>" class="form-control mb-3">

                <input type="submit" name="update" value="Update" class="btn btn-primary">
            </form>
        </div>
    </div>
</section>
</body>
</html>