<?php require viewsPath('partials/header');?>
  <div style="color:#444">
    <center ><h4><i class="fa fa-user-shield"></i> Admin Panel</h4></center>
    <div class="row container-fluid">
      <div class="col-12 col-md-3 col-sm-4 col-lg-2">
        <ul class="list-group">
          <a href="index.php?pg=admin&tab=dashboard">
            <li class="list-group-item  <?= !$tab||$tab=='dashboard' ?'active':''?>"><i class="fa fa-th-large"></i> Dashboard</li>
          </a>
          <a href="index.php?pg=admin&tab=users">
            <li class="list-group-item <?=$tab=='users' ?'active':''?>"><i class="fa fa-users"></i>  Users</li>
          </a>
          <a href="index.php?pg=admin&tab=products">
            <li class="list-group-item <?=$tab=='products' ?'active':''?>"><i class="fa-brands fa-product-hunt"></i>  Products</li>
          </a>
          <a href="index.php?pg=admin&tab=sales">
            <li class="list-group-item <?=$tab=='sales' ?'active':''?>"><i class="fa fa-money-bill-wave"></i>  Sales</li>
          </a>
          <a href="index.php?pg=admin&tab=stock">
            <li class="list-group-item <?=$tab=='stock' ?'active':''?>"><i class="fa-sharp fa-solid fa-money-bill-trend-up"></i>  Stock</li>
          </a>
          <a href="index.php?pg=admin&tab=reports">
            <li class="list-group-item <?=$tab=='reports' ?'active':''?>"><i class="fa fa-money-bill-wave"></i>  Reports</li>
          <a href="index.php?pg=home">
            <li class="list-group-item <?=$tab=='reports' ?'active':''?>"><i class="fa-solid fa-cart-shopping"></i> cart</li>
          </a>
          <a href="index.php?pg=logout">
            <li class="list-group-item"><i class="fa fa-sign-out-alt"></i> Logout</li>
          </a>
        </ul>
      </div>
      <div class="border col">
        <h4><?=strtoupper($tab)?></h4>
        <?php
        switch($tab){
          case 'products':
            require viewsPath('admin/products');
            break;
          case 'users':
            require viewsPath('admin/users');
            break;
          case 'sales':
            require viewsPath('admin/sales');
            break;
          case 'stock':
            require viewsPath('admin/stock');
            break;
          default:
          require viewsPath('admin/dashboard');
          break;
        }
        ?>
      </div>
    </div>
  </div>

<?php require viewsPath('partials/footer');?>
