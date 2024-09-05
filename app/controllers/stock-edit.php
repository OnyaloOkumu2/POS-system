<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion");
  $id = $_GET['id'] ?? null;
  $product = new Product();
  $row = $product->get_one_res(["id"=>$id]);
  $errors=[];
  if(!empty($_SERVER['HTTP_REFERER'])){
    $_SESSION['referer']=$_SERVER['HTTP_REFERER'];
  }
  if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
    $errors = $product->validate($_POST,$row['id']);
    if($_POST['qty']<0){
      $_POST['qty'] = 1;
    }
    $new_qty =(int) $_POST['qty'];
    $_POST['qty'] = $new_qty+$row['qty'];
    if($_POST['buying_price']==$row['buying_price']){
      unset($_POST['buying_price']);
    }
    
    
      $product->update($row['id'],$_POST);
      redirect("admin&tab=stock");
  }
  if(Auth::access('admin')){
    require viewsPath('product/stock-edit');
  }else{
    Auth::set_message("only Admin is Allowed to update Stock");
    require viewsPath('auth/denied');
  }
    