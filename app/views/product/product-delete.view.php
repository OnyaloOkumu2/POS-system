<?php require viewsPath('partials/header');?>

  <div class="container-fluid border rounded p-3 m-2 col-lg-4 mx-auto shadow">
  <?php if(!empty($row)):?>
    <form method="POST" enctype="multipart/form-data">
      <h5 class="text-primary"><i class="fa-brands fa-product-hunt"></i> Delete Product</h5>
      <div class="alert alert-danger text-center">Are you sure you want to delete this product ??!</div>
      <hr>
      <div class="mb-1">
        <label for="prod" class="form-label">Product name</label>
        <input type="text" class="form-control shadow-none" id="prod" name="description" placeholder="product name" value="<?=set_value("description",$row['description'])?>"disabled>
      </div>
      <div class="mb-1">
        <label for="barcode" class="form-label">Barcode</label>
        <input type="text" class="form-control shadow-none" id="barcode" name="barcode" placeholder="barcode"value="<?=set_value("description",$row['barcode'])?>" disabled>
      </div>
      <div class="img text-center">
          <h6>Product Image</h6>
          <img src="<?=crop_image($row['image'])?>" class="img-fluid rounded" style="width:200px">
      </div>
      <button type="submit" class="btn btn-danger float-end shadow-none">Delete</button>
      <a href="index.php?pg=admin&tab=products"><button type="button" class="btn btn-secondary shadow-none">Cancel</button></a>
    </form>
    <?php else: ?>
      That product was not found <br><br>
      <a href="index.php?pg=admin&tab=products"><button type="button" class="btn btn-primary shadow-none">back to product</button></a>
    <?php endif; ?>
  </div>
<?php require viewsPath('partials/footer');?>