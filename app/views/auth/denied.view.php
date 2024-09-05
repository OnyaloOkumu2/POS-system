<?php require viewsPath('partials/header');?>
   <center>
      <h1 class="text-danger">Access Denied!</h1>
      <div>
         <?=Auth::get_message();?>
      </div>
   </center>
<?php require viewsPath('partials/footer');?>