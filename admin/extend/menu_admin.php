
<?php
include '../conexion/conexion.php';
$sel_compania= $con->prepare("SELECT id, compania FROM compania WHERE id = ?");
$sel_compania -> bind_param('i', $_SESSION['compania']);
$sel_compania -> execute();
$sel_compania -> bind_result($id, $compania);
$sel_compania->fetch();
 ?>
  <nav class="black">
    <a href="#" data-activates="menu" class="button-collapse"><i class="material-icons">menu</i></a>
    <ul class="right hide-on-med-and-down">
      <select  name="compania" required>
         <option value="<?php echo $id?>" selected><?php echo $compania ?></option>
         <?php
         $sel_compania->close();
         $sel= $con->prepare("SELECT id, compania FROM compania ");
         $sel -> execute();
         $sel -> bind_result($id, $compania);
         $row = mysqli_num_rows($res);
          ?>
         <?php while ($sel->fetch()) { ?>
         <option value="<?php echo $id?>" ><?php echo  $compania?></option>
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
    <!-- <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">work</i>PROPIEDADES
    <i class="material-icons right">arrow_drop_down</i></a></li>
    <li><div class="divider"></div></li>
    <li><a href="../inicio/slider.php"><i class="material-icons">web</i>SLIDER</li></a>
    <li><div class="divider"></div></li>-->
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
