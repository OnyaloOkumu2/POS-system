<?php
  defined("ABS_PATH") ? "":die("Access denied");
  $errors=[];
  if($_SERVER['REQUEST_METHOD'] == "POST"){
    $_POST['role'] = "user";
    $_POST['date'] = date("Y-m-d H:i:s");
    $user= new User();
    $errors = $user->validate($_POST);
    if(empty($errors)){
      $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
      $user->insert($_POST);
      redirect("admin&tab=users");
    }
  }
  if(Auth::access('admin')){
    require viewsPath('auth/signup');
  }else{
    Auth::set_message("Only admin can create user");
    require viewsPath('auth/denied');
  }
  