<ul class="nav nav-tabs">
  <li class="nav-item">
    <a class="nav-link <?=($section=='table') ? 'active':''?>" aria-current="page" href="index.php?pg=admin&tab=sales">Table view</a>
  </li>
  <li class="nav-item ">
    <a class="nav-link <?=($section=='graph') ? 'active':''?>" href="index.php?pg=admin&tab=sales&s=graph">Graph view</a>
  </li>
</ul>

  <?php if($section=='table') : ?>
  <div class="container-fluid">  
    <form class="row float-end" action="index.php?pg=admin&tab=sales">
      <div class="col">
        <label for="start">Start Date:</label>
        <input id="start" type="date" name="start_date" class="form-control shadow-none" value="<?=!empty($_GET['start_date'])?$_GET['start_date']:''?>">
      </div>
      <div class="col">
        <label for="end">End Date:</label>
        <input id="end" type="date" name="end_date" class="form-control shadow-none" value="<?=!empty($_GET['end_date'])?$_GET['end_date']:''?>">
        </div>
        <div class="col">
        <label for="start">Rows:</label>
        <input id="start" type="number" name="limit" min="1" class="form-control shadow-none" value="<?=!empty($_GET['limit'])?$_GET['limit']:'10'?>" style="max-width: 80px;">
      </div>
        <button style="max-width: 50px;" type="submit" class="btn align-items-center col btn-primary btn-sm">Go<i class="fa fa-chevron-right"></i></button>
        <input type="hidden" name="pg" value="admin">
        <input type="hidden" name="tab" value="sales">
    </form>
    <div class="clearfix"></div>
  </div>
  <div class="table-responsive">
    <div><h3> Todays total ksh. <?=number_format($sales_total)?></h3></div>
    <table class="table table-striped table-hover  rounded ">
      <thead class="text-center bg-primary text-white">
        <tr>
          <th>Receipt No.</th>
          <th>Products</th>
          <th>Qty</th>
          <th>Amount</th>
          <th>Total</th>
          <th>Cashier</th>
          <th>Date</th>
          <th>
            <a href="index.php?pg=home"><button class="btn btn-sm btn-success shadow-none"><i class="fa fa-plus"></i> ADD NEW</button></a>
          </th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php if(!empty($sales)):?>
          <?php foreach ($sales as $sale):?>
            <tr>
            <td>
              <?=$sale['receipt_no']?>
            </td>
            <td class="text-start">
              <?=esc($sale['description']);?>
            </td>
            <td class="text-center"><?=esc($sale['qty']);?></td>
            <td class="text-start"><?="Ksh.".esc($sale['amount']);?></td>
            <td class="text-start"><?="Ksh.".esc($sale['total']);?></td>
              <?php
              $cashier = get_user_id($sale['user_id']);
              if(empty($cashier)){
                $name ="unknown";
                $nameLink ="#";
              }else{
                $name =$cashier['username'];
                $nameLink="index.php?pg=profile&id=".$cashier['id'];
              }
              ?>
            <td>
              <a href="<?=$nameLink?>"><?=esc($name)?></a>  
            </td>
            <td><?=date_convert($sale['date']);?></dh>
            <td>
              <a href="index.php?pg=sales-edit&id=<?=$sale['id']?>">
                <button class="btn btn-sm btn-info shadow-none">Edit</button>
              </a>
              <a href="index.php?pg=sales-delete&id=<?=$sale['id']?>">
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
  <?php else: ?>
    <h4>graph view</h4>
    <?php
      $graph = new Graph();
    ?>
    <br>
    <?php
    $data = generate_daily_sales_data($today_records);
    $graph->title ="Todays Hourly Sales";
    $graph->styles ="width:75%;margin:auto;display:block;";
    $graph->xTitle ="Hours of the day";
    $graph->display($data);
    ?>
    <br>
    <?php
    $data = generate_monthly_sales_data($thisMonth_record);
    $graph->title ="THis Month Sales Graph";
    $graph->xTitle ="days of the Month";
    $graph->display($data);
    ?>
    <br>
    <?php
    $data = generate_yearly_sales_data($thisMonth_record);
    $graph->title ="This Year Sales Graph";
    $graph->xTitle ="Months of The Year";
    $graph->display($data);
    ?>
  <?php endif ;?>  