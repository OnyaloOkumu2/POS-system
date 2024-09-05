<?php
  session_start();
  require "../app/core/init.php";
  define("ABS_PATH",true);
  define("ABSPATH",__DIR__);
  $controller = $_GET['pg'] ?? "home";//check if the page exits if not it set it to home
  $controller =strtolower($controller);

  // show($controller);
  if(file_exists("../app/controllers/".$controller.".php")){
    require "../app/controllers/".$controller.".php";
  }else{
    echo "Controller not found";
    die;
  }
  