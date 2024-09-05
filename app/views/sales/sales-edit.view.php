<?php require viewsPath('partials/header');?>

   <div class="container-fluid border rounded p-3 m-2 col-lg-4 mx-auto shadow">
   <?php if(!empty($row)):?>
      <form method="POST" enctype="multipart/form-data">
      <center><h5 class="text-primary"><i class="fa fa-money-bill"></i> Edit Sales</h5></center>
      <hr>
      <div class="mb-1">
         <label for="prod" class="form-label">Product name</label>
         <div class="form-control"><?=$row['description']?></div>
      </div>
      <div class="mb-3">
         <label for="barcode" class="form-label">Barcode</label>
         <div class="form-control"><?=$row['barcode']?></div>
      </div>
      <div class="input-group mb-1">
      <span class="input-group-text">Quantity</span>
         <input type="number" name="qty" id="" class="form-control shadow-none <?=!empty($errors['qty'])?'border-danger':''?>" placeholder="Quantity" aria-label="Quantity"value="<?=set_value("qty",$row['qty'])?>" autofocus>
         <span class="input-group-text">price</span>
         <input type="number" step="0.50" name="amount"class="form-control shadow-none" placeholder="Price" aria-label="Price" value="<?=$row['amount']?>">
      </div>
   
      <button type="submit" class="btn btn-danger float-end shadow-none">Save</button>
      <a href="index.php?pg=admin&tab=sales"><button type="button" class="btn btn-primary shadow-none">Cancel</button></a>
      </form>
      <?php else: ?>
      That record was not found <br><br>
      <a href="index.php?pg=admin&tab=sales"><button type="button" class="btn btn-primary shadow-none">back to Sales</button></a>
      <?php endif; ?>
   </div>
<?php require viewsPath('partials/footer');?>