<?php
   defined("ABS_PATH") ? "":die("Access denied");
   $id = $_GET['id'] ?? null;
   $user= new User();
   $row = $user->get_one_res(["id"=>$id]);
   $errors=[];
   if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
      // make sure only admins can make other Admins
      
      if($_POST['role'] == "admin"){
         if(!Auth::get("role")=="admin"){
            $_POST['role'] = "user";
         }
      }


      $errors = $user->validate($_POST,$id);
      if(empty($errors)){
         if(empty($_POST['password'])){

            unset($_POST['password']);
         }else{
            $_POST['password'] = password_hash($_POST['password'],PASSWORD_DEFAULT);
         }

         $user->update($id,$_POST);
         redirect("admin&tab=users");
      }
   }
   if(Auth::access('admin')){
      require viewsPath('auth/user-edit');
   }else{
      Auth::set_message("Only admin can edit system users");
      require viewsPath('auth/denied');
   }