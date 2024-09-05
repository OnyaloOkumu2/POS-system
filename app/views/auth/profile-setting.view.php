<?php 
if(!empty($_SESSION['referer'])){
   $back_link = $_SESSION['referer'];
}else{
   $back_link="index.php?pg=home";
}
?>
<?php require viewsPath('partials/header');?>
   
   <div class="container-fluid border col-lg-5 col-md-7 mt-4 p-4 shadow-lg  rounded">
   <?php if(is_array($row)): ?>
      <center>
         <h3><i class="fa fa-key"></i> Change Password</h3>
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
            <label for="email" class="form-label">Gender</label>
            <div class="form-control"><?=$row['gender']?></div>
         </div>
         <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Enter old Password</span>
            <input type="password" class="form-control shadow-none <?=!empty($errors['password_old'])?'border-danger':''?>"  name="password_old" value="<?=set_value("password",'')?>"placeholder="Enter old password" aria-label="Username" aria-describedby="basic-addon1"><br>
            <?php if(!empty($errors['password_old'])):?>
            <small class="text-danger col-12"><?=$errors['password_old']?></small>
            <?php endif;?>
         </div>
         <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Password</span>
            <input type="password" class="form-control shadow-none <?=!empty($errors['password'])?'border-danger':''?>"  name="password" value="<?=set_value("password",'')?>"placeholder="New pass" aria-label="Username" aria-describedby="basic-addon1"><br>
            <?php if(!empty($errors['password'])):?>
            <small class="text-danger col-12"><?=$errors['password']?></small>
            <?php endif;?>
         </div>
         
         <div class="input-group mb-1">
         <span class="input-group-text" id="basic-addon1">Retype Password</span>
         <input type="password" class="form-control shadow-none <?=!empty($errors['password_retype'])?'border-danger':''?>"  name="password_retype" value="<?=set_value("password_retype",'')?>"placeholder="confirm Pass" aria-label="Username" aria-describedby="basic-addon1">
         <?php if(!empty($errors['password_retype'])):?>
         <small class="text-danger col-12"><?=$errors['password_retype']?></small>
         <?php endif;?>
         </div>
         <br>
         <button type="submit" class="btn btn-success shadow-none float-end">Save</button>
         <a href="<?=$back_link?>"><button type="button" class="btn btn-danger shadow-none">Cancel</button></a>
      </form>
      <?php else: ?>
         <div class="alert alert-danger text-center">
            That User was not Found!
         </div>
         <br><br>
         <a href="<?=$back_link?>"><button type="button" class="btn  btn-lg btn-danger shadow-none">Cancel</button></a>
      <?php endif; ?>
   </div>

   <?php require viewsPath('partials/footer');?>
