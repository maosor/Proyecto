
<?php
include '../conexion/conexion.php';
$sel_compania= $con->prepare("SELECT id, compania FROM compania WHERE id = ?");
$sel_compania -> bind_param('i', $_SESSION['compania']);
$sel_compania -> execute();
$res_compania = $sel_compania -> get_result();
if($f_compania = $res_compania->fetch_assoc())
{
  $compania = $f_compania['compania'];
}
$sel= $con->prepare("SELECT id, compania FROM compania ");
$sel -> execute();
$res = $sel -> get_result();
$row = mysqli_num_rows($res);
 ?>
  <nav class="black">
    <a href="#" data-activates="menu" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <select  name="conpania" required>
         <option value="<?php echo $_SESSION['compania']?>" ><?php echo $compania ?></option>
         <?php while ($f = $res->fetch_assoc()) { ?>
         <option value="<?php echo $f['id']?>" ><?php echo  $f['compania']?></option>
         <?php } ?>
      </select>
    </ul>
  </nav>
  <ul id="menu" class="side-nav fixed">
    <li>
      <div class="userView">
        <div class="background fixed">
          <img src="../css/images/abstract-q-c-640-480-9.jpg">
        </div>
        <a href="../perfil/index.php"><img src="../usuario/<?php echo $_SESSION['foto'] ?>" class="circle" alt=""></a>
          <a href="../perfil/perfil.php" class="white-text"><?php echo $_SESSION['nombre'] ?></a>
          <a href="../perfil/perfil.php" class="white-text"><?php echo $_SESSION['correo'] ?> </a>
      </div>
    </li>
    <li><a href="../inicio"><i class="material-icons">home</i>INICIO</li></a>
    <li><div class="divider"></div></li>
    <?php if($_SESSION['nivel'] == 'ADMINISTRADOR'){?>
    <li><a href="../usuario"><i class="material-icons">contacts</i>USUARIOS</li></a>
    <li><div class="divider"></div></li>
    <li><a href="../compania"><i class="material-icons">business</i>COMPAÑIA</li></a>
    <li><div class="divider"></div></li>
    <?php } ?>
    <li><a href="../clientes"><i class="material-icons">contact_phone</i>CLIENTES</li></a>
    <li><div class="divider"></div></li>
    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">work</i>PROPIEDADES
      <i class="material-icons right">arrow_drop_down</i></a></li>
    <li><div class="divider"></div></li>
    <li><a href="../inicio/slider.php"><i class="material-icons">web</i>SLIDER</li></a>
    <li><div class="divider"></div></li>
    <li><a href="../login/salir.php"><i class="material-icons">power_setting_new</i>SALIR</li></a>
    <li><div class="divider"></div></li>
  </ul>

  <ul id="dropdown1" class="dropdown-content">
    <li><a href="../propiedades/index.php">GENERAL</a></li>
    <li><a href="../propiedades/index.php?ope=VENTA">VENTA</a></li>
    <li><a href="../propiedades/index.php?ope=RENTA">RENTA</a></li>
    <li><a href="../propiedades/index.php?ope=TRASPASO">TRASPASO</a></li>
    <li><a href="../propiedades/index.php?ope=OCUPADO">OCUPADO</a></li>
    <li><a href="../propiedades/cancelados.php">CANCELADOS</a></li>
   </ul>
