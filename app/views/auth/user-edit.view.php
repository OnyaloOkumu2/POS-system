
<?php require viewsPath('partials/header');?>
   
   <div class="container-fluid border col-lg-5 col-md-7 mt-4 p-4 shadow-lg  rounded">
   <?php if(is_array($row)): ?>
      <center>
         <h3><i class="fa fa-user"></i> Edit User credentials</h3>
         <div><?=esc(APP_NAME)?></div>
      </center>
      <hr>
      
      <form method="POST">
         <div class="mb-1">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control shadow-none <?=!empty($errors['username'])?'border-danger':''?>" id="username"  name="username"placeholder="username" autofocus value="<?=set_value("username",$row['username'])?>">
            <?php if(!empty($errors['username'])):?>
            <small class="text-danger"><?=$errors['username']?></small>
            <?php endif;?>
         </div>
         <div class="mb-1">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control shadow-none <?=!empty($errors['email'])?'border-danger':''?>" id="email"  name="email"placeholder="example@gmail.com" autofocus  value="<?=set_value("email",$row['email'])?>">
            <?php if(!empty($errors['email'])):?>
            <small class="text-danger"><?=$errors['email']?></small>
            <?php endif;?>
         </div>

         <div class="mb-1">
            <label for="gender" class="form-label">Gender</label>
            <select class="form-control  shadow-none" name="gender" id="gender">
               <option value="male">male</option>
               <option value="female">female</option>
            </select>
         </div>
         <div class="mb-1">
            <label for="role" class="form-label">Role</label>
            <select class="form-control  shadow-none" id="role" name="role">
               <?php if($row['id']==1): ?>
               <option value="admin">admin</option>
               <?php else: ?>
               <option value="user">user</option>
               <option value="cashier">cashier</option>
               <option value="accountant">accountant</option>
               <option value="supervisor">supervisor</option>
               <option value="admin">admin</option>
               <?php endif; ?>
            </select>
         </div>
         <div class="mb-1">
            <label for="role" class="form-label">User Deletable</label>
            <select class="form-control  shadow-none" id="role" name="deletable">
               <?php if($row['id']==1  ): ?> 
               <option value="0">No</option>
               <?php else: ?>
               <option value="1">yes</option>
               <option value="0">No</option>
               <?php endif; ?>
            </select>
         </div>
         <div class="input-group mb-1">
            <span class="input-group-text" id="basic-addon1">Password</span>
            <input type="password" class="form-control shadow-none <?=!empty($errors['password'])?'border-danger':''?>"  name="password" value="<?=set_value("password",'')?>"placeholder="Leave Empty to not change" aria-label="Username" aria-describedby="basic-addon1"><br>
            <?php if(!empty($errors['password'])):?>
            <small class="text-danger col-12"><?=$errors['password']?></small>
            <?php endif;?>
         </div>
         
         <div class="input-group mb-1">
         <span class="input-group-text" id="basic-addon1">Retype Password</span>
         <input type="password" class="form-control shadow-none <?=!empty($errors['password_retype'])?'border-danger':''?>"  name="password_retype" value="<?=set_value("password_retype",'')?>"placeholder="Leave empty to no change" aria-label="Username" aria-describedby="basic-addon1">
         <?php if(!empty($errors['password_retype'])):?>
         <small class="text-danger col-12"><?=$errors['password_retype']?></small>
         <?php endif;?>
         </div>
         <br>
         <button type="submit" class="btn btn-success shadow-none float-end">Save</button>
         <button type="cancel" class="btn btn-danger shadow-none">Cancel</button>
      </form>
      <?php else: ?>
         <div class="alert alert-danger text-center">
            That User was not Found!
         </div>
         <br><br>
         <a href="index.php?pg=admin&tab=users"><button type="button" class="btn  btn-lg btn-danger shadow-none">Cancel</button></a>
      <?php endif; ?>
   </div>

   <?php require viewsPath('partials/footer');?>
