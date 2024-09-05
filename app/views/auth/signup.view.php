
<?php require viewsPath('partials/header');?>
  <div class="container-fluid border col-lg-5 col-md-7 mt-4 p-4 shadow-lg  rounded">
    <center>
      <h3><i class="fa fa-user"></i>Create User</h3>
      <div><?=esc(APP_NAME)?></div>
    </center>
    <hr>
    <form method="POST">
      <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control shadow-none <?=!empty($errors['username'])?'border-danger':''?>" id="username"  name="username"placeholder="username" autofocus value="<?=set_value("username")?>">
        <?php if(!empty($errors['username'])):?>
        <small class="text-danger"><?=$errors['username']?></small>
        <?php endif;?>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="text" class="form-control shadow-none <?=!empty($errors['email'])?'border-danger':''?>" id="email"  name="email"placeholder="example@gmail.com" autofocus  value="<?=set_value("email")?>">
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
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Password</span>
        <input type="password" class="form-control shadow-none <?=!empty($errors['password'])?'border-danger':''?>"  name="password" value="<?=set_value("password")?>"placeholder="Password" aria-label="Username" aria-describedby="basic-addon1"><br>
        <?php if(!empty($errors['password'])):?>
        <small class="text-danger col-12"><?=$errors['password']?></small>
        <?php endif;?>
      </div>
      
      <div class="input-group mb-3">
        <span class="input-group-text" id="basic-addon1">Retype Password</span>
        <input type="password" class="form-control shadow-none <?=!empty($errors['password_retype'])?'border-danger':''?>"  name="password_retype" value="<?=set_value("password_retype")?>"placeholder="password" aria-label="Username" aria-describedby="basic-addon1">
        <?php if(!empty($errors['password_retype'])):?>
        <small class="text-danger col-12"><?=$errors['password_retype']?></small>
        <?php endif;?>
      </div>
      <br>
      <button type="submit" class="btn btn-primary shadow-none float-end">Create</button>
      <button type="cancel" class="btn btn-danger shadow-none">Cancel</button>
    </form>
  </div>
  <?php require viewsPath('partials/footer');?>
