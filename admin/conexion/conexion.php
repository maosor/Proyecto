<?php @session_start();
  $con = new mysqli('localhost', 'root', '', 'sailsiadco');
  $con->set_charset('utf8');
  require_once '../extend/log4php.php';
 ?>
