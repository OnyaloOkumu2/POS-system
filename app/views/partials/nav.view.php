<nav class="navbar navbar-expand-lg navbar-light bg-light" style="min: width 350px;">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php?pg=home"><?=esc(APP_NAME)?></a>
      <button class="navbar-toggler shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php?pg=pos">Point of sale</a>
          </li>
          <?php if (Auth::access('supervisor')): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=admin">Admin</a>
          </li>
          <?php endif; ?>
          <?php if (!Auth::logged_in()): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=login">Login</a>
          </li>
          <?php else: ?>
          <?php if (Auth::access('admin')): ?>
          <li class="nav-item">
            <a class="nav-link" href="index.php?pg=signup">Create User</a>
          </li>
          <?php endif; ?>

          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Hi, <?=Auth::get('username')?>,(<?=Auth::get('role')?>)
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="index.php?pg=profile">Profile</a></li>
              <li><a class="dropdown-item" href="index.php?pg=profile-setting&id=<?=Auth::get('id')?>">Profile-settings</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="index.php?pg=logout">Logout</a></li>
            </ul>
          </li>
          <?php endif; ?>
          <li class="nav-item">
            <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          </li>
        </ul>
        <form class="d-flex">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>