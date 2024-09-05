<?php
   defined("ABS_PATH") ? "":die("Access denied");
   $id = $_GET['id'] ?? null;
   $user= new User();
   $row = $user->get_one_res(["id"=>$id]);
   $errors=[];
   if($_SERVER['REQUEST_METHOD'] == "POST" && is_array($row)){
      // make sure only admins can make other Admins
      if(Auth::access('admin') && $row['deletable']){
         $user->delete($id);
         redirect("admin&tab=users");
      }
   }
   if(Auth::access('admin')){
      require viewsPath('auth/user-delete');
   }else{
      Auth::set_message("Only admin can delete  system users");
      require viewsPath('auth/denied');
   }