<?php
   defined("ABS_PATH") ? "":die("Access denied");
   $id = $_GET['id'] ?? Auth::get('id');
   $user= new User();
   $row = $user->get_one_res(["id"=>$id]);
   $errors=[];
   if(Auth::access('user')){
      require viewsPath('auth/profile');
   }else{
      Auth::set_message("Only admin can edit system users");
      require viewsPath('auth/denied');
   }