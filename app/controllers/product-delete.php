<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion");
  $id = $_GET['id'] ?? null;
  $product = new Product();
  $row = $product->get_one_res(["id"=>$id]);
  $errors=[];
  if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
    $product->delete($row['id']);
        // delete old file
    if(file_exists($row['image'])){
      unlink($row['image']);
    }
    redirect("admin&tab=products");
  }
  if(Auth::access('admin')){
    require viewsPath('product/product-delete');
  }else{
    Auth::set_message("Only admin can delete product");
    require viewsPath('auth/denied');
  }
    