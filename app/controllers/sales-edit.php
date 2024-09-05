<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion");
  $id = $_GET['id'] ?? null;
  $sales = new Sale();
  $row = $sales->get_one_res(["id"=>$id]);
  $errors=[];
  if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
      $qty = (int) $_POST['qty'];
      $amount = (int) $_POST['amount'];
      $_POST['total']= $qty*$amount;
      $sales->update($row['id'],$_POST);
      redirect("admin&tab=sales");
  }
  if(Auth::access('supervisor')){
    require viewsPath('sales/sales-edit');
  }else{
    Auth::set_message("you don't have right to edit product");
    require viewsPath('auth/denied');
  }
    