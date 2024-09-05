<?php
    defined("ABS_PATH") ? "":die("Access denied");
    //capture ajax data;
    $raw_data =file_get_contents("php://input");
    if(!empty($raw_data)){
        $OBJ = json_decode($raw_data,true);
        if(is_array($OBJ)){
            if($OBJ['dataTYpe']=="search"){
                $productClass = new Product();
                $rows=[];
                $limit =20;
                if(!empty($OBJ['text'])){
                    //search
                    $text ="%".$OBJ['text']."%";
                    $barcode=$OBJ['text'];
                    $query ="SELECT * FROM `products` WHERE (`description` LIKE :find||`barcode`=:barcode) && `qty`> 0  ORDER BY `views` DESC  LIMIT $limit";
                    $rows = $productClass->query($query,['find' =>$text,'barcode' =>$barcode]);
                    
                }else{
                    //get All
                    $query="SELECT * FROM products WHERE `qty` > 0 ORDER BY `views` DESC LIMIT 20";
                    $rows=$productClass->query($query);
                }
                if($rows){
                    foreach($rows as $key=>$row){
                        $row[$key]["description"] = strtoupper($row["description"]);
                        $rows[$key]['image'] = crop_image($row['image']);
                    }
                    $type_res="search";
                    $output =["dataType"=>$type_res,"data"=>$rows];
                    echo json_encode($output);
                }
            }else 
            if($OBJ['dataTYpe']=="checkout"){
                $checkout_data =$OBJ['text'];
                $receipt_no = get_receipt_no();
                $user_id =auth('id');
                $date = date("Y-m-d H:i:s");
                $db = new Database();
                //read from database
                foreach($checkout_data as $row){
                    $arr=[];
                    $arr['id']  = $row['id'];
                    $query =("SELECT * FROM `products` WHERE `id` = :id LIMIT 1");
                    $check=$db->query($query,$arr);
                    if(is_array($check)){
                        //save to database
                        $check =$check[0];
                        $arr=[];
                        $views=$check['views']+1;
                        $arr['barcode'] = $check['barcode'];
                        $arr['description'] = $check['description'];
                        $arr['amount'] = $check['amount'];
                        $arr['qty'] = $row['qty'];
                        $arr['receipt_no'] = $receipt_no;
                        $arr['date'] = $date;
                        $arr['user_id'] = $user_id;
                        $arr['total'] = $row['qty']*$check['amount'];
                        $arr['buying_price'] = $check['buying_price'];
                        $query="INSERT INTO `sales` (barcode,receipt_no,description,qty,amount,total,date,user_id,buying_price)VALUES(:barcode,:receipt_no,:description,:qty,:amount,:total,:date,:user_id,:buying_price)";
                        $db->query($query,$arr);
                        // add view count for this product
                        $new_quantity = (int)$check['qty'] - (int) $row['qty']; 
                        if($new_quantity<0){
                            $new_quantity = 0;
                        }
                        $query="UPDATE `products` SET `views`= :views,`qty`=:qty WHERE `id`=:id LIMIT 1";
                        $db->query($query,['id' =>$check['id'],'views' =>$views,'qty' =>$new_quantity]);
                    }
                }
                //id	barcode	receipt_no	description	qty	amount	total	date	user_id	
                $type_res="checkout";
                $output =["dataType"=>$type_res,"data"=>"items saved successfully"];
                echo json_encode($output);
            }else 
            if($OBJ['dataTYpe']=="getStock"){
                $prodClass = new Product();
                $rows =[];
                $table_data="";
                if(empty($OBJ['text'])){
                    $rows=$prodClass->get_all(10,0,"desc","views");
                    $it =1;
                    foreach($rows as $row){
                        $image = crop_image($row['image']);
                        $table_data .="
                        <tr>
                        <td>$it</td>
                        <td>
                            <img src='$image' width='35px' class='me-2 img-fluid rounded'>
                        </td>
                        <td>
                            <a href='index.php?pg=product-edit&id=$row[id]'>
                            <b>$row[description]</b>
                            </a>
                        </td>
                        <td class='text-center'>
                            <b>$row[qty]</b>
                        </td>
                        <td class='text-center'>
                        <b>$row[buying_price]</b>
                        </td>
                        <td class='text-center'>
                        <b>$row[amount]</b>
                        </td>
                        <td>
                            <a href='index.php?pg=stock-edit&id=$row[id]'>
                                <button class='btn btn-sm btn-warning shadow-none'><i class='fa-solid fa-pen-to-square'></i>Update</button>
                            </a>
                        </td>
                        </tr>
                    ";
                    $it++;
                    }
                }else{
                    $text ="%".$OBJ['text']."%";
                    $barcode=$OBJ['text'];
                    $query ="SELECT * FROM `products` WHERE `description` LIKE :find||`barcode`=:barcode  ORDER BY `views` DESC  LIMIT 10";
                    $rows = $prodClass->query($query,['find' =>$text,'barcode' =>$barcode]);
                    if(!$rows){
                        $table_data= "";
                        return;
                    }
                    $it =1;
                    foreach($rows as $row){
                        $image = crop_image($row['image']);
                        $table_data .="
                        <tr>
                        <td>$it</td>
                        <td>
                            <img src='$image' width='35px' class='me-2 img-fluid rounded'>
                        </td>
                        <td>
                            <a href='index.php?pg=product-edit&id=$row[id]'>
                            <b>$row[description]</b>
                            </a>
                        </td>
                        <td class='text-center'>
                            <b>$row[qty]</b>
                        </td>
                        <td class='text-center'>
                        <b>$row[buying_price]</b>
                        </td>
                        <td class='text-center'>
                        <b>$row[amount]</b>
                        </td>
                        <td>
                            <a href='index.php?pg=stock-edit&id=$row[id]'>
                                <button class='btn btn-sm btn-warning shadow-none'><i class='fa-solid fa-pen-to-square'></i>Update</button>
                            </a>
                        </td>
                        </tr>
                    ";
                    $it ++;
                }
                }
                echo $table_data;
            }
        }
    }

