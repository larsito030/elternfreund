<?php
  require_once('../ef_dummy/inc/config.php');
  require_once('../ef_dummy/inc/functions.php');
  $out = login_valid();
  //var_dump($out);
  //die();
  /*$out = password_correct();
  echo $out;
  die();*/

?>

   <!DOCTYPE html>
<html>
    <?php include('../ef_dummy/inc/head.php'); ?>
    <body>
   <div class="nav-wrap">   
	  <?php include('../ef_dummy/inc/menu.php'); ?>
<!--Login Window -->
    <?php include('../ef_dummy/inc/widgets/modal_window.php');
          include ('../ef_dummy/inc/widgets/msg_modal.php');?>
    </div>
