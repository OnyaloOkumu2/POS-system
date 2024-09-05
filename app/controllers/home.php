<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion");
  if(Auth::access('cashier')){
    require viewsPath('home');
  }else{
    redirect('login');
  }