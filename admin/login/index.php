<?php
include '../conexion/conexion.php';
if ($_SERVER['REQUEST_METHOD']== 'POST'){
  $user = $con->real_escape_string(htmlentities($_POST['usuario']));
  $pass = $con->real_escape_string(htmlentities($_POST['contra']));
  $candado = ' ';
  $str_u = strpos($user, $candado);
  $str_p = strpos($pass, $candado);

  if (is_int($str_u)){
    $user = '';
  }else {
    $usuario = $user;
  }
  if (is_int($str_p)){
    $pass = '';
  }else {
    $pass2 = sha1($pass);
  }
  if ($user == null && $pass == null) {
    header('location:../extend/alerta.php?msj=El formato no es correcto&c=salir&p=salir&t=error');
  }else {
    $sel= $con->query("SELECT id, nick, nombre, nivel, correo, foto, pass, id_compania FROM usuario WHERE nick = '$usuario' AND pass = '$pass2'
         AND bloqueo = 1");
       if (!$sel) {
    $log->error('Error - SQLSTATE: '.$con->error);
}
$con->close();
       $row = mysqli_num_rows($sel);
       if ($row == 1) {
         if ($var = $sel->fetch_assoc()) {
            $compania = $var['id_compania'];
            $id = $var['id'];
            $nick = $var['nick'];
            $contra = $var['pass'];
            $nivel = $var['nivel'];
            $correo = $var['correo'];
            $foto = $var['foto'];
            $nombre = $var['nombre'];
         }
         if ($nick == $usuario && $contra == $pass2 ) {
            $_SESSION ['compania'] = $compania;
            $_SESSION ['id_usuario'] = $id;
            $_SESSION ['nick'] = $nick;
            $_SESSION ['nombre'] = $nombre;
            $_SESSION ['nivel'] = $nivel;
            $_SESSION ['correo'] = $correo;
            $_SESSION ['foto'] = $foto;
            if($nivel == 3){
              header('location:../produccion/index.php');
            }
            else
              {
              header('location:../inicio/index.php');
              }
           }
       }else {
         header('location:../extend/alerta.php?msj=Nombre de usuario o contraseña incorrecto o bloquedo&c=salir&p=salir&t=error');
       }
  }
}else {
  header('location:../extend/alerta.php?msj=Utilza el formulario&c=salir&p=salir&t=error');
}
 ?>
