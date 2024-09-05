<?php
   defined("ABS_PATH") ? "":die("Access denied");

   $id = $_GET['id'] ?? null;
   if($id==Auth::get('id')){
   $user= new User();
   $row = $user->get_one_res(["id"=>$id]);
   $errors=[];
   if(!empty($_SERVER['HTTP_REFERER'])){
      $_SESSION['referer']=$_SERVER['HTTP_REFERER'];
   }

   if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
      if(empty($_POST['password_old'])){
         $errors['password_old']="Enter old password";
      }else
      if(empty($_POST["password"])){
         $errors['password']="password is required";
      }else if($_POST['password']!==$_POST['password_retype']){
         $errors['password']="password does not match";
         $errors['password_retype']="password does not match";
      }else if(strlen($_POST['password'])<8){
         $errors['password']="password must be at least 8 characters long";
      }else
      if(!password_verify($_POST['password_old'],$row['password'])){
         $errors['password_old']="Old password mismatch";
      }

      if(empty($errors)){
         $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
         $user->update($id,$_POST);
         redirect("home");
      }
   }
   if(Auth::access('user') && $row){
      require viewsPath('auth/profile-setting');
   }else{
      Auth::set_message("you are not allowed to use this system");
      require viewsPath('auth/denied');
   }
   }else{
      Auth::set_message("you are not Logged in as the current user to make changes for this user go to edit Tab");
      require viewsPath('auth/denied');
   }