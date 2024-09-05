<?php require viewsPath('partials/header');?>

  <div class="container-fluid border rounded p-3 m-2 col-lg-4 mx-auto shadow">
  <?php if(!empty($row)):?>
    <form method="POST" enctype="multipart/form-data">
      <h5 class="text-primary"><i class="fa-brands fa-product-hunt"></i> Edit Product</h5>
      <hr>
      <div class="mb-1">
        <label for="prod" class="form-label">Product name</label>
        <input type="text" class="form-control shadow-none <?=!empty($errors['description'])?'border-danger':''?>" id="prod" name="description" placeholder="product name" autofocus value="<?=set_value("description",$row['description'])?>">
        <?php if(!empty($errors['description'])):?>
        <small class="text-danger"><?=$errors['description']?></small>
        <?php endif;?>
      </div>
      <div class="mb-1">
        <label for="barcode" class="form-label">Barcode (optional)</label>
        <input type="text" class="form-control shadow-none" id="barcode" name="barcode" placeholder="barcode (optional)" autofocus value="<?=set_value("description",$row['barcode'])?>">
      </div>
      <div class="input-group mb-1">
      <span class="input-group-text">Quantity</span>
        <input type="number" name="qty" id="" class="form-control shadow-none <?=!empty($errors['qty'])?'border-danger':''?>" placeholder="Quantity" aria-label="Quantity"value="<?=set_value("qty",$row['qty'])?>">
        <span class="input-group-text">price</span>
        <input type="number" step="0.50" name="amount" id="" class="form-control shadow-none <?=!empty($errors['amount'])?'border-danger':''?>" placeholder="Price" aria-label="Price" value="<?=set_value("amount",$row['amount'])?>" >
      </div>
        <?php if(!empty($errors['qty'])):?>
          <small class="text-danger"><?=$errors['qty']?></small>
        <?php endif;?>
        <?php if(!empty($errors['amount'])):?>
          <small class="text-danger"><?=$errors['amount']?></small>
        <?php endif;?>
      <div class="mb-1">
        <label for="formFile" class="form-label">Product image</label>
        <input type="file" name="image" id="formFile" class="form-control shadow-none">
        <?php if(!empty($errors['image'])):?>
        <small class="text-danger"><?=$errors['image']?></small>
        <?php endif;?>
      </div>
      <div class="img text-center">
          <img src="<?=crop_image($row['image'])?>" class="img-fluid rounded" style="width:200px">
      </div>
      <button type="submit" class="btn btn-danger float-end shadow-none">Save</button>
      <a href="index.php?pg=admin&tab=products"><button type="button" class="btn btn-primary shadow-none">Cancel</button></a>
    </form>
    <?php else: ?>
      That product was not found <br><br>
      <a href="index.php?pg=admin&tab=products"><button type="button" class="btn btn-primary shadow-none">back to product</button></a>
    <?php endif; ?>
  </div>
<?php require viewsPath('partials/footer');?>