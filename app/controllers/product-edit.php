<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion");
  $id = $_GET['id'] ?? null;
  $product = new Product();
  $row = $product->get_one_res(["id"=>$id]);
  $errors=[];
  if($_SERVER['REQUEST_METHOD'] == "POST" && $row){
    $_POST['barcode'] = empty($_POST['barcode'])?$product->generate_barcode():$_POST['barcode'];
    if(!empty($_FILES['image']['name'])){
      $_POST['image'] = $_FILES['image'];
    }
    $errors = $product->validate($_POST,$row['id']);
  
    if(empty($errors)){
      $folder = "uploads/";
      if(!file_exists($folder)){
        mkdir($folder, 0777, true);
      }
      if(!empty($_POST['image'])){
        $ext =strtolower(pathinfo($_POST['image']['name'],PATHINFO_EXTENSION));
        $destination = $folder.$product->generate_filename($ext);
        move_uploaded_file($_POST['image']['tmp_name'],$destination);
        $_POST['image']=$destination;
        // delete old file
        if(file_exists($row['image'])){
          unlink($row['image']);
        }
      }
      $product->update($row['id'],$_POST);
      redirect("admin&tab=products");
    }
  }
  if(Auth::access('supervisor')){
    require viewsPath('product/product-edit');
  }else{
    Auth::set_message("you don't have right to edit product");
    require viewsPath('auth/denied');
  }
    