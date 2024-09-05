<?php
   defined("ABS_PATH") ? "":die("Please stop phishing invasion");
   $vars = $_GET['data'] ?? "";
   $obj = json_decode($vars, true);
  
   require viewsPath('print');