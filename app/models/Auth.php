<?php
   class Auth{
      public static function get($column){
         if(!empty($_SESSION['USER'][$column])){
               return $_SESSION['USER'][$column];
            }
            return "unknown";
         }
      public static function logged_in(){
         if(!empty($_SESSION['USER'])){
            $db = new Database();
            if($check = $db->query("SELECT * FROM  `users` WHERE `email` =:email LIMIT 1",['email'=>$_SESSION['USER']['email']])){
               return true;
            }
         }
         return false;
      }
      public static function access($role){
         $access['admin']        =['admin'];
         $access['supervisor']   =['admin','supervisor'];
         $access['accountant']   =['admin','accountant'];
         $access['cashier']      =['admin','supervisor','cashier'];
         $access['user']         =['admin','supervisor','cashier','user'];
         $my_role = self::get('role');
         if(in_array($my_role,$access[$role])){
            return true;
         }
         return false;
      }
      public static function set_message($message){
         $_SESSION['MESSAGE']=$message;
      }
      public static function get_message(){
         if(!empty($_SESSION['MESSAGE'])){
            $message = $_SESSION['MESSAGE'];
            unset($_SESSION['MESSAGE']);
            return $message;
         }
         
      }
   }