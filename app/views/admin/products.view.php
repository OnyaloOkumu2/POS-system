  <div class="table-responsive">
    <table class="table table-striped table-hover  rounded ">
      <thead class="text-center bg-primary text-white">
        <tr>
          <th>Image</th>
          <th>Product</th>
          <th>Barcode</th>
          <th>Qty</th>
          <th>Price</th>
          <th>Date</th>
          <th>
            <a href="index.php?pg=product-new"><button class="btn btn-sm btn-success shadow-none"><i class="fa fa-plus"></i> ADD</button></a>
          </th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php if(!empty($products)):?>
          <?php foreach ($products as $product):?>
            <tr>
            <td>
              <img src="<?=crop_image($product['image'])?>" style="width:50px;" class="img-fluid rounded">
            </td>
            <td class="text-start">
              <a href="index.php?pg=product-single&id=<?=$product['id']?>">
              <?=esc($product['description']);?>
              </a>
            </td>
            <td class=""><?=esc($product['barcode']);?></td>
            <td><?=esc($product['qty']);?></td>
            <td><?="Ksh.".esc($product['amount']);?></td>
            <td><?=date_convert($product['date']);?></dh>
            <td>
              <a href="index.php?pg=product-edit&id=<?=$product['id']?>">
                <button class="btn btn-sm btn-info shadow-none">Edit</button>
              </a>
              <a href="index.php?pg=product-delete&id=<?=$product['id']?>">
                <button class="btn btn-sm btn-danger shadow-none">Delete</button>
              </a>
            </td>
          </tr>
          <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    <?php
    $pager->display_pagination();
    ?>
  </div>