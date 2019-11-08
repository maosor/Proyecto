<?php @session_start();
include '../conexion/conexion.php';
if (!isset($_SESSION['nick'])){
  header('location:../');
}
 ?>
 <!DOCTYPE html>

 <html lang="es">

 <head>
 <title>Proyecto</title>
 <meta charset="utf-8" />
 <meta name = "viewport" content="width=device-width, initial-scale=1.0">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <link rel="stylesheet" href="../css/materialize.min.css" />
  <link rel="stylesheet" href="../css/styles.css" />
 <link href="../css/icons.css" rel="stylesheet">
 <link rel="shortcut icon" href="/favicon.ico" />
 <style media="screen">
 header, main, footer {
   padding-left: <?php echo ($_SESSION['nivel'] <= 2 )? "300px" : "0"; ?>;
 }
 .button-collapse
 {
    display: none;
 }
 body{
   text-transform: uppercase;
 }
 @media only screen and (max-width:992px) {
   header, main, footer{
     padding-left: 0;
   }
   .button-collapse
   {
      display: inherit;
   }
 }
 .fixed {
  [type="checkbox"], [type="radio"] {
    + label {
      pointer-events: auto;
    }
  }
}
 </style>
 </head>
 <body class="grey lighten-3">
<main>
<?php
//if($_SESSION['nivel'] == 'ADMINISTRADOR'){
    include '../extend/menu_admin.php';
//}
//else {
//    include '../extend/menu_asesor.php';
//}
 ?>
