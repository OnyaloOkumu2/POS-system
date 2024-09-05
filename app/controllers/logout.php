<?php
  defined("ABS_PATH") ? "":die("Access denied");
  if(isset($_SESSION['USER'])){
    unset($_SESSION['USER']);
    redirect('login');
    die;
  }
  redirect('login');