<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion");
  $id = $_GET['id'] ?? null;
  $sale = new Sale();
  $row = $sale->get_one_res(["id"=>$id]);
  $errors=[];
  if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
    $sale->delete($row['id']);
    redirect("admin&tab=sales");
  }
  if(Auth::access('admin')){
    require viewsPath('sales/sales-delete');
  }else{
    Auth::set_message("Only admin can delete sales");
    require viewsPath('auth/denied');
  }
    