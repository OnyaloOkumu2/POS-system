<?php
  defined("ABS_PATH") ? "":die("Please stop phishing invasion please contact Admin");
  $tab = $_GET['tab'] ?? 'dashboard';

  if($tab=="products"){
    $limit = 10;
    $pager = new Pager($limit);
    $offset = $pager->offset;
    $productClass = new Product();
    $products = $productClass->query("SELECT * FROM `Products` ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
  }else
  if($tab=="users"){
    $limit = 10;
    $pager = new Pager($limit);
    $offset = $pager->offset;
    $userClass = new User();
    $users = $userClass->query("SELECT * FROM `users` ORDER BY `id` DESC LIMIT $limit OFFSET $offset");
  }else
  if($tab=="sales"){
    $section =$_GET['s'] ?? 'table';
    $start_date =$_GET['start_date'] ?? null;
    $end_date =$_GET['end_date'] ?? null;
    $salesClass = new Sale();
    $limit =$_GET['limit']?? 6;
    $limit = (int) $limit;
    $limit = ($limit <1) ? 7: $limit;
    $pager = new Pager($limit);
    $offset = $pager->offset;
    //pagination
    
    $page_number =$_GET['page'] ?? 1;
    $offset =($page_number-1)*$limit;
    $query ="SELECT * FROM `sales` ORDER BY `id` DESC LIMIT $limit  OFFSET $offset";
    //get daily sales
    $year = date("Y");
    $month = date("m");
    $day = date("d");
    $query_total="SELECT sum(total) as total FROM `sales` WHERE day(date)=$day && month(date) =$month && year(date)=$year";

    if($start_date && $end_date){
      $st_date=date("Y-m-d",strtotime($start_date));

      $end_date=date("Y-m-d",strtotime($end_date));
      $query ="SELECT * FROM `sales` WHERE date BETWEEN  '$st_date' AND '$end_date' ORDER BY `id` DESC LIMIT $limit  OFFSET $offset";
      $query_total ="SELECT sum(total) AS `total`  FROM `sales` WHERE date BETWEEN  '$st_date' AND '$end_date'";
    }else
    if($start_date && !$end_date){
      $st_year=date("Y",strtotime($start_date));
      $st_month=date("m",strtotime($start_date));
      $st_day=date("d",strtotime($start_date));

      $query ="SELECT * FROM `sales` WHERE year(date)='$st_year' && month(date)='$st_month' && day(date)='$st_day' ORDER BY `id` DESC LIMIT $limit  OFFSET $offset";
      $query_total ="SELECT sum(total) AS `total`  FROM `sales` WHERE year(date)='$st_year' && month(date)='$st_month' && day(date)='$st_day'";
    }
    $sales = $salesClass->query($query);
  
    $st = $salesClass->query($query_total);
    $sales_total =0;
    if($st){
      $sales_total = $st[0]['total']??0;
    }
    if($section=="graph"){

      // read graph data from
      $db = new Database();
      //query  todays records
      $today =date("Y-m-d");
      $query ="SELECT total,date FROM `sales` WHERE DATE(date)='$today'";
      $today_records = $db->query($query);
      //query  this month records
      $thisMonth =date("m");
      $thisYear =date("Y");
      $query ="SELECT total,date FROM `sales` WHERE month(date)='$thisMonth' && year(date)='$thisYear'";
      $thisMonth_record = $db->query($query);
      //query this year records
      $this_year =date("Y");
      $query2 ="SELECT total,date FROM `sales` WHERE  YEAR(date)='$this_year'";
      $thisYear_record = $db->query($query2);
    }
  }else if($tab =="reports"){
    
  }
  else{
    $db = new Database();
    $query ="SELECT count(id) AS user_count FROM `users`";
    $myUsers=$db->query($query);
    $total_users = $myUsers[0]['user_count'];

    $query ="SELECT count(id) AS products_count FROM `products`";
    $myUsers=$db->query($query);
    $total_products = $myUsers[0]['products_count'];

    $query ="SELECT sum(total) AS total  FROM `sales`";
    $myUsers=$db->query($query);
    $daily_sales  = $myUsers[0]['total'];
  }
  if(Auth::access('supervisor')){
    require viewsPath('admin/admin');
  }else{
    Auth::set_message("You don't have access to admin page");
    require viewsPath('auth/denied');
  }