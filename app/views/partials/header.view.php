<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?=esc(APP_NAME)?></title>
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/all.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/main.css">
</head>
<body>
  <?php
  $no_nav[]="login";
  $no_nav[]="print";
  if(!in_array($controller,$no_nav)):?>
    <?php require viewsPath('partials/nav');?>
  <?php endif;?>
  <div class="container-fluid" style="min-width:350px;">