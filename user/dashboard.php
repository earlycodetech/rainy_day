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
        <div class="col-md-4">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-user"></i> USER NAME</h4>
              <h5 class="text-end mt-3"><?php echo $row['first_name']." ".$row['last_name']; ?></h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-calendar"></i> DEPARTMENT</h4>
              <h5 class="text-end mt-3"><?php echo $row['department']; ?></h5>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 mb-3">
              <h4><i class="fas text-info fa-envelope"></i> EMAIL</h4>
              <h5 class="text-end mt-3"><?php echo $row['email']; ?></h5>
            </div>
        </div>
      </div>
    </div>
</section>
<!-- USER SECTION STARTS HERE -->
<?php if ($_SESSION['role'] != 'admin') { echo errorMessage(); echo successMessage(); ?>
<section>
  <h1 class="text-light">User</h1>

  
</section>


<!-- ADMIN SECTION STARTS HERE -->
  <?php }else {  
      echo errorMessage(); echo successMessage();
    ?>
    
      <section>
        <form action="view" method="get" class="container py-2">
            <div class="row">
              <div class="col-11">
                <input type="text" name="qs" placeholder="Enter User ID" class="form-control">
              </div>
              <div class="col-1">
                <button class="btn btn-primary">
                  <i class="fas fa-search"></i>
                </button>
              </div>
            </div>
        </form>
        <div class="table-responsive container">
        <table class="table text-light table-dark">
            <thead>
              <tr>
                <th scope="col">ID</th>
                <th scope="col">Full Name</th>
                <th scope="col">Department</th>
                <th scope="col"></th>
              </tr>
            </thead>
            <tbody>
            <?php  
              $sql = "SELECT * FROM users WHERE user_role = 'user' ORDER BY id DESC LIMIT 10";
              $query = mysqli_query($connectDB,$sql);
             
             while( $row = mysqli_fetch_assoc($query)){
            ?>
              <tr>
                <th scope="row"><?php echo $row['userid']; ?></th>
                <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                <td><?php echo strtoupper($row['department']); ?></td>
                <td>
                  <a href="view?qs=<?php echo $row['userid'] ?>" class="btn btn-sm btn-primary">
                    <i class="fas fa-eye"></i>
                  </a>
                </td>
              </tr>

              <?php } ?>
            </tbody>
          </table>
        </div>
      </section>
    <?php } ?>
</body>
</html>