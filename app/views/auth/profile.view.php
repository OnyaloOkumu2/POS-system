
<?php require viewsPath('partials/header');?>
   
   <div class="container-fluid border col-lg-5 col-md-7 mt-4 p-4 shadow-lg  rounded">
   <?php if(is_array($row)): ?>
      <center>
         <h3><i class="fa fa-user"></i> User Profile</h3>
      </center>
      <table class="table table-hover table-striped">
         <tr>
         <center>
            <td colspan="2">
               <img src="<?=crop_image($row['image'],400,$row['gender'])?>" style="width:50px;" class="img-fluid rounded">
            </td>
         </center>
         </tr>   
         <tr>
            <th>Username :</th>
            <td><?=$row['username']?></td>
         </tr>
         <tr>
            <th>Email :</th>
            <td><?=$row['email']?></td>
         </tr>
         <tr>
            <th>Gender :</th>
            <td><?=$row['gender']?></td>
         </tr>
         <tr>
            <th>Role :</th>
            <td><?=$row['role']?></td>
         </tr>
         <tr>
            <th>Date created :</th>
            <td><?=date_convert($row['date']);?></td>
         </tr>
      </table>
      <a href="index.php?pg=profile-setting&id=<?=$row['id']?>"><button type="button" class="btn w-100  btn-primary shadow-none">Edit</button></a>
      <?php else: ?>
         <div class="alert alert-danger text-center">
            That User was not Found!
         </div>
         <br><br>
         <a href="index.php?pg=admin&tab=users"><button type="button" class="btn  btn-lg btn-danger shadow-none">Cancel</button></a>
      <?php endif; ?>
   </div>

   <?php require viewsPath('partials/footer');?>
