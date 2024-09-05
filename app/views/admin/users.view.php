  <div class="table-responsive">
    <table class="table table-striped table-hover  rounded ">
      <thead class="text-center bg-primary text-white">
        <tr>
          <th>Image</th>
          <th>userName</th>
          <th>Gender</th>
          <th>Email</th>
          <th>Date Enrolled</th>
          <th>Role</th>
          <th>
            <a href="index.php?pg=signup"><button class="btn btn-sm btn-success shadow-none"><i class="fa fa-plus"></i> CREATE USER</button></a>
          </th>
        </tr>
      </thead>
      <tbody class="text-center">
        <?php if(!empty($users)):?>
          <?php foreach ($users as $user):?>
            <tr>
            <td>
              <a href="index.php?pg=profile&id=<?=$user['id']?>">
                <img src="<?=crop_image($user['image'],400,$user['gender'])?>" style="width:50px;" class="img-fluid rounded">
              </a>
            </td>
            <td class="text-start">
              <a href="index.php?pg=profile&id=<?=$user['id']?>">
                <?=esc($user['username']);?>
              </a>  
            </td>
            <td class=""><?=esc($user['gender']);?></td>
            <td class=""><?=esc($user['email']);?></td>
            <td><?=date_convert($user['date']);?></td>
            <td class=""><?=esc($user['role']);?></td>
            <td>
              <a href="index.php?pg=user-edit&id=<?=$user['id']?>">
                <button class="btn btn-sm btn-info shadow-none">Edit</button>
              </a>
              <a href="index.php?pg=user-delete&id=<?=$user['id']?>">
                <button class="btn btn-sm btn-danger shadow-none">Delete</button>
              </a>
            </td>
          </tr>
          <?php endforeach;?>
        <?php endif;?>
      </tbody>
    </table>
    <?php
    $pager->display_pagination(count($users));
    ?>
  </div>