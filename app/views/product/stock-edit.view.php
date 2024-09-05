  <?php 
  if(!empty($_SESSION['referer'])){
    $back_link = $_SESSION['referer'];
  }else{
    $back_link="index.php?pg=home";
  }
  ?>
<?php require viewsPath('partials/header');?>
  <div class="container-fluid border rounded p-3 m-2 col-lg-4 mx-auto shadow">
  <?php if(!empty($row)):?>
    <form method="POST" enctype="multipart/form-data">
      <center>
        <h5 class="text-primary"><i class="fa-sharp fa-solid fa-money-bill-trend-up"></i> Update Stock</h5>
      </center>
      <hr>
      <div class="mb-1">
        <label for="prod" class="form-label">Product name</label>
        <div class="form-control"><?=$row['description']?></div>
      </div>
      <div class="mb-1">
        <label for="prod" class="form-label">Current Stock</label>
        <div class="form-control"><?=$row['qty']?></div>
      </div>
      <div class="mb-1">
        <label for="prod" class="form-label">Current Price</label>
        <div class="form-control"><?=$row['amount']?></div>
  </div>
      <div class="mb-1">
        <label class="form-label">Enter Buying Price for Each</label>
        <input type="number" class="form-control shadow-none <?=!empty($errors['buying_price'])?'border-danger':''?>"  name="buying_price" placeholder="Buying Price" autofocus value="<?=set_value("buying_price",$row['buying_price'])?>">
        <?php if(!empty($errors['buying_price'])):?>
        <small class="text-danger"><?=$errors['buying_price']?></small>
        <?php endif;?>
      </div>
      <div class="mb-1">
        <label for="prod" class="form-label">Enter Added Quantity</label>
        <input type="number" class="form-control shadow-none <?=!empty($errors['qty'])?'border-danger':''?>" id="prod" name="qty" placeholder="product name" autofocus value="0">
        <?php if(!empty($errors['qty'])):?>
        <small class="text-danger"><?=$errors['qty']?></small>
        <?php endif;?>
      </div>
      <button type="submit" class="btn btn-danger float-end shadow-none">Save</button>
      <a href="<?=$back_link?>"><button type="button" class="btn btn-primary shadow-none">Cancel</button></a>
    </form>
    <?php else: ?>
      That product was not found <br><br>
      <a href="<?=$back_link?>"><button type="button" class="btn btn-primary shadow-none">back to product</button></a>
    <?php endif; ?>
  </div>
<?php require viewsPath('partials/footer');?>