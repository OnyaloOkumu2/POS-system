<?php
//class product
class Sale extends Model{
   protected $table ="sales";
   protected $allowed_columns = ['qty','barcode','description','amount','total','date','receipt_no','user_id','buying_price'];

   public function validate($data,$id=null){
      $errors=[];
      //check description
      if(empty($data["description"])){
         $errors['description']="product name is required";
      }else if(!preg_match("/[a-zA-Z0-9]+/",$data['description'] )){
         $errors['username']="only letters and spaces are allowed";
      }
      //check quantity
      if(empty($data["qty"])){
         $errors['qty']="product Quantity is required";
      }else if(!preg_match("/^[0-9]+$/",$data['qty'] )){
         $errors['qty']="Quantity must be a number";
      }
      //check Amount
      if(empty($data["amount"])){
         $errors['amount']="product price is required";
      }else if(!preg_match("/^[0-9.]+$/",$data['amount'] )){
         $errors['amount']="Price must be a number";
      }
      //check image
      $allowed_images = ['image/jpeg', 'image/png', 'image/jpg'];
      $image_max_size = 2;//mbs
      $size = $image_max_size*(1024*1024);//mbs
      ;
      if(!$id ||($id && !empty($data['image']))){
         if(empty($data["image"])){
            $errors['image']="image is required";
         }else if(!($data["image"]["type"]=="image/jpeg"||$data["image"]["type"]=="image/png")){
            $errors['image']="image must be a valid JPG or PNG";
         }else if($data['image']['error']>0){
            $errors['image']="image failed to upload error: ".$data['image']['error'];
         }else if($data['image']['size'] > $size){
            $errors['image']="Image must be lower than size: ".$image_max_size."Mbs";
         }
      }
      return $errors;
   }
   public function generate_barcode(){
      $barcode = 'PROD_'.random_int(11111,99999)."POS_K";
      return $barcode;
   }
   public function generate_filename($ext="jpeg") {
      $fileName = "FILE_".random_int(11111,99999).".$ext";
      return $fileName;
   }
}