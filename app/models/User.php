<?php
//user table class
class User extends Model{
  protected $table ="users";
  protected $allowed_columns = ['username','email','password','role','image','date','gender','deletable'];
  public function validate($data,$id=null){
    $errors=[];
      //check username
      if(empty($data["username"])){
        $errors['username']="username is required";
      }else if(!preg_match("/^[a-zA-Z ]+$/",$data['username'] )){
        $errors['username']="only letters and spaces are allowed";
      }
      //check email
      if(empty($data["email"])){
        $errors['email']="Email is required";
      }else if(!filter_var($data['email'], FILTER_VALIDATE_EMAIL)){
        $errors['email']="Email is not valid";
      }
      //check password
      if(!$id){
        if(empty($data["password"])){
          $errors['password']="password is required";
        }else if($data['password']!==$data['password_retype']){
          $errors['password']="password does not match";
          $errors['password_retype']="password does not match";
        }else if(strlen($data['password'])<8){
          $errors['password']="password must be at least 8 characters long";
        }
      }else{
        if(!empty($data["password"])){
          if($data['password']!==$data['password_retype']){
              $errors['password']="password does not match";
              $errors['password_retype']="password does not match";
            }else 
            if(strlen($data['password'])<8){
            $errors['password']="password must be at least 8 characters long";
          }
      }
    }
    return $errors;
  }
}