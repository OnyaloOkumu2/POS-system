
<?php require viewsPath('partials/header');?>
   
   <div class="container-fluid border col-lg-5 col-md-7 mt-4 p-4 shadow-lg  rounded">
   <?php if(is_array($row) && $row['deletable']): ?>
      <center>
         <h3><i class="fa fa-user"></i> Remove user</h3>
         <div class="alert alert-danger text-center">Are you sure want to remove this user ???!</div>
      </center>
      <hr>
      
      <form method="POST">
         <div class="mb-1">
            <label for="username" class="form-label">Username</label>
            <div class="form-control"><?=$row['username']?></div>
         </div>
         <div class="mb-1">
            <label for="email" class="form-label">Email</label>
            <div class="form-control"><?=$row['email']?></div>
         </div>

         <div class="mb-1">
            <label for="gender" class="form-label">Gender</label>
            <div class="form-control"><?=$row['gender']?></div>
         </div>
         <div class="mb-1">
            <label for="role" class="form-label">Role</label>
            <div class="form-control"><?=$row['role']?></div>
         </div>
         <br>
         <button type="submit" class="btn btn-danger shadow-none float-end">Delete</button>
         <button type="cancel" class="btn btn-secondary shadow-none">Cancel</button>
      </form>
      <?php else: ?>
         <?php if(is_array($row) && !$row['deletable']):?>
         <div class="alert alert-danger text-center">
            This user cannot be deleted
         </div>
         <br><br>
         <?php else: ?>
            <div class="alert alert-danger text-center">
            That user was not found!
         </div>
         <br><br>
         <?php endif; ?>
         <a href="index.php?pg=admin&tab=users"><button type="button" class="btn  btn-lg btn-danger shadow-none">Cancel</button></a>
      <?php endif; ?>
   </div>

   <?php require viewsPath('partials/footer');?>
