
<?php require viewsPath('partials/header');?>
  <div class="container-fluid border col-lg-4 col-md-5 mt-4 p-4 shadow-lg  rounded">
    <center>
      <h1><i class="fa fa-user"></i></h1>
      <h3>Login</h3>
      <div><?=esc(APP_NAME)?></div>
    </center>
    <hr>
    <form method="POST" autocomplete="off">
      <div class="mb-3">
        <input  type="email" value="<?=set_value("email")?>"class="form-control shadow-none <?=!empty($errors['email'])?'border-danger':''?>" id="email" placeholder="Email" name="email" autofocus>
        <?php if(!empty($errors['email'])):?>
        <small class="text-danger"><?=$errors['email']?></small>
        <?php endif;?>
      </div>
      <div class="input-group mb-2">
        <span class="input-group-text" id="basic-addon1">Password</span>
        <input type="password" class="form-control shadow-none <?=!empty($errors['password'])?'border-danger':''?>" placeholder="Password"aria-describedby="basic-addon1" name="password">
        <?php if(!empty($errors['password'])):?>
        <small class="text-danger col-12"><?=$errors['password']?></small>
        <?php endif;?>
      </div>
      <br>
      <div class="row">
        <button type="submit" class="btn btn-primary shadow-none" style="width:100px font-size:20px">Login</button>
      </div>
    </form>
  </div>
  <?php require viewsPath('partials/footer');?>
