<?php
  date_default_timezone_set("Africa/Nairobi");
  require "../app/core/config.php";
  require "../app/core/function.php";
  require "../app/core/database.php";
  require "../app/core/model.php";
  // require "../app/models/user.php";
  // require "../app/models/product.php";
  spl_autoload_register('my_function');//Load classes whenever they are required
  function my_function($class_name){
    $file_name= "../app/models/".ucfirst($class_name).".php";
    if(file_exists($file_name)){
      require $file_name;
    }
  }

