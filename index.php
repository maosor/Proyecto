<?php include 'admin/conexion/conexion_web.php'; ?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name = "viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="admin/css/materialize.min.css" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" href="/favicon.ico" />

    <title>Sitio Web</title>
  </head>
  <body>
    <nav class="red"> </nav>
    <div class="slider">
      <ul class="slides">
        <?php
          $sel = $con->prepare("SELECT * FROM slider");
          $sel -> execute();
          $res = $sel -> get_result();
          while ($f= $res ->fetch_assoc()) {?>
        <li>
          <img src="admin/inicio/<?php echo $f['ruta']?> "> <!-- random image -->
          <div class="caption center-align">
            <h3>Empresa</h3>
            <h5 class="light grey-text text-lighten-3">Slogan de la empresa</h5>
          </div>
        </li>
        <?php }
        $sel->close(); ?>
      </ul>
    </div>
    <script
        src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="admin/js/materialize.min.js"></script>
    <script>
      $('.slider').slider();
    </script>
  </body>
</html>
