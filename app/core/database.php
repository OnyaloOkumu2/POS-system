<?php
//database class
  class Database{

    private function db_connect(){
      $dbHost ="localhost";
      $dbName ="pos_db";
      $dbUser ="root";
      $dbPass ="";
      $dbDriver="mysql";
      $port=3310;
      try{
        $con = new PDO("$dbDriver:host=$dbHost;port=$port;dbname=$dbName",$dbUser,$dbPass);
      }catch(PDOException $e){
        echo $e->getMessage();
      }
      return $con;
    }
    public function query($query,$data=array()){
      $con = $this->db_connect();
      $smt = $con->prepare($query);
      $check =$smt->execute($data);
      if($check){
        $result = $smt->fetchAll(PDO::FETCH_ASSOC);
        //result can be boolean array(), array(1233);
        if(is_array($result) && count($result)>0){
          return $result;
        }
      }
      return false;
    }
  }
  