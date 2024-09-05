<?php
// model
class Model extends Database{
  protected function get_allowed_columns($data){
    if(!empty($this->allowed_columns)){
      foreach($data as $key=>$value){
        //code...
        if(!in_array($key,$this->allowed_columns)){
          unset($data[$key]);
        }
      }
    }
    return $data;
  }
  public function insert($data){
    $clean_array = $this->get_allowed_columns($data,$this->table);
    $keys=array_keys($clean_array);
    $query ="INSERT INTO $this->table";
    $query .="(".implode(",",$keys).") VALUES ";
    $query .="(:".implode(",:",$keys).")";
    $this->query($query,$clean_array);
  }
  public function update($id,$data){
    $clean_array = $this->get_allowed_columns($data,$this->table);
    $keys=array_keys($clean_array);
    $query ="UPDATE $this->table SET ";
    foreach($keys as $column){
      $query .= $column."=:".$column.",";
    }
    
    $query =trim($query,",");
    $query .=" WHERE id = :id";
    $clean_array['id']=$id;

    $this->query($query,$clean_array);
  }
  public function delete($id){
    $query ="DELETE FROM $this->table WHERE id = :id LIMIT 1";
    $clean_array['id']=$id;
    $this->query($query,$clean_array);
  }
  public function where($data,$limit=10,$offset=0){
    $keys=array_keys($data);
    $query ="SELECT * FROM $this->table WHERE ";
    foreach($keys as $key){
      $query .=" $key = :$key &&";
    }
    $query = trim($query,"&&");
    $query .=" LIMIT $limit offset $offset";
    return $this->query($query,$data);
  }
  public function get_all($limit=10,$offset=0,$order="desc",$order_col="id"){
    $query ="SELECT * FROM $this->table  ORDER BY $order_col $order LIMIT $limit offset $offset ";
    return $this->query($query);
  }
  public function get_one_res($data){
    $keys=array_keys($data);
    $query ="SELECT * FROM $this->table WHERE  ";
    foreach($keys as $key){
      $query .="$key = :$key &&";
    }
    $query = trim($query,"&& ");
    if($res = $this->query($query,$data)){
      return $res[0];
    }
    return false;
  }
}

