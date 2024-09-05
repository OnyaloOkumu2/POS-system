<?php require viewsPath('partials/header');?>

   <div class="container-fluid border rounded p-3 m-2 col-lg-4 mx-auto shadow">
   <?php if(!empty($row)):?>
      <form method="POST" enctype="multipart/form-data">
         <center>
         <h5 class="text-primary"><i class="fa fa-money-bill"></i> Delete Sale</h5>
         </center>
         <div class="alert alert-danger text-center">Are you sure you want to delete this record ??!</div>
         <hr>
         <div class="mb-1">
         <label for="prod" class="form-label">Product Description</label>
         <input type="text" class="form-control shadow-none" id="prod" name="description" placeholder="product name" value="<?=set_value("description",$row['description'])?>"disabled>
         </div>
         <div class="mb-1">
         <label for="barcode" class="form-label">Barcode</label>
         <input type="text" class="form-control shadow-none" id="barcode" name="barcode" placeholder="barcode"value="<?=set_value("description",$row['barcode'])?>" disabled>
         </div>
         <div class="mb-1">
            <label class="form-label">Quantity Sold</label>
            <div class="form-control"><?=$row['qty']?>@<?=$row['amount']?></div>
         </div>
         <div class="mb-1">
            <label class="form-label">Total cost</label>
            <div class="form-control">Ksh.<?=$row['total']?></div>
         </div>
         <div class="mb-1">
            <label class="form-label">Date completed</label>
            <div class="form-control"><?=date_convert($row['date'])?></div>
         </div>
         <button type="submit" class="btn btn-danger float-end shadow-none">Delete</button>
         <a href="index.php?pg=admin&tab=products"><button type="button" class="btn btn-secondary shadow-none">Cancel</button></a>
      </form>
      <?php else: ?>
         That sales record was not found <br><br>
         <a href="index.php?pg=admin&tab=sales"><button type="button" class="btn btn-primary shadow-none">back to sales</button></a>
      <?php endif; ?>
   </div>
<?php require viewsPath('partials/footer');?>