<?php

   if($_SERVER['REQUEST_METHOD'] =="POST"){

   $Wshell = new COM("WScript.Shell");
   $obj = $Wshell->Run("cmd /c wscript.exe ".ABSPATH."/file.vbs",0,true); 
   $Wshell = new COM("WScript.Shell");
   $obj = $Wshell->Run("cmd /c wscript.exe ".ABSPATH."/file.vbs",0,true);  

   // $Wshell = new COM("WScript.Shell");
   // $obj1 = $Wshell->Run("cmd /c wscript.exe www/public/file.vbs",0,true); 
   }
?>
   <!DOCTYPE html>
   <html lang="en">
   <head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title><?=esc(APP_NAME)?></title>
      <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
      <link rel="stylesheet" type="text/css" href="assets/css/main.css">
   </head>
   <body>
      <?php if(is_array($obj)): ?>
      <center>   
      <div class="col-10 border mt-5">   
      <center>
         <h1><?=$obj['company']?></h1>
         <h4>Goods receipt</h4>
         <h5><i><?=date("jS F, Y  H:i")?></i></h5>
      </center>
      <table class="table table-striped">
         <thead class="text-center">
         <tr>
            <th class="text-start">Description</th><th>Qty</th><th>@</th><th class="text-end">Amount</th>
         </tr>
         </thead>
         <tbody>
            <?php foreach($obj['data'] as $row):?>
            <tr>
               <td class="text-start"><?=$row['description']?></td>
               <td class="text-center"><?=$row['qty']?></td>
               <td class="text-center">Ksh. <?=$row['amount']?></td>
               <td class="text-end">Ksh. <?=number_format($row['amount']*$row['qty'])?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
               <td colspan="2"></td>
               <td class="fw-bold text-center">Total:</td>
               <td class="text-end">Ksh. <?=$obj['grandTotal']?></td>
            </tr>
         </tbody>
         <tr>
            <td colspan="2"></td>
            <td class="fw-bold text-center">Amount Paid:</td>
            <td class="text-end">Ksh. <?=$obj['amount']?></td>
         </tr>
         <tr>
            <td colspan="2"></td>
            <td class="fw-bold text-center">Balance:</td>
            <td class="text-underline text-end">Ksh. <u><?=number_format($obj['change'])?><u></td>
         </tr>
      </table>
      <?php 
         $user=get_user_id(Auth::get('id'))
      ?>
      <center><i> Thanks For shopping with us</i></center>
      <center><i> served by : <?=$user['username'] ?></i></center>
      <?php endif;?>
      </div>
      </center>
   <script>
      window.print();
      let ajax =new XMLHttpRequest();
      ajax.open("POST","",true);
      ajax.onload =function(){

      }
      ajax.send();

   </script>   
   </body>
   </html>