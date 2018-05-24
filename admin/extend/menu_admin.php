
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
      <select  name="compania" id="compania" required>
         <option value="<?php echo $id?>" disabled selected><?php echo $compania ?></option>
         <?php
         $sel_compania->close();
         $sel= $con->prepare("SELECT c.id cid, compania FROM usuario_compania uc inner join compania c on uc.id_compania=c.id
         WHERE uc.id_usuario= ? ");
         $sel -> bind_param('i', $_SESSION['id_usuario']);
         $sel -> execute();
         $sel -> bind_result($cid, $compania);
         ?>
         <?php while ($sel->fetch()) { ?>
         <option value="<?php echo $cid?>" ><?php echo  $compania?></option>
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
    <?php if($_SESSION['nivel'] <= 1){?>
    <li><a href="../usuario"><i class="material-icons">contacts</i>USUARIOS</li></a>
    <li><div class="divider"></div></li>
  <?php } ?>
    <?php if($_SESSION['nivel'] == 0){?>
    <li><a href="../compania"><i class="material-icons">business</i>COMPAÑIA</li></a>
    <li><div class="divider"></div></li>
    <?php } ?>
    <?php if($_SESSION['nivel'] <= 2){?>
    <li><a href="../cotizacion"><i class="material-icons">assignment_turned_in</i>COTIZAR</li></a>
    <li><div class="divider"></div></li>
  <?php } ?>
    <li><a href="../clientes"><i class="material-icons">contact_phone</i>CLIENTES</li></a>
    <li><div class="divider"></div></li>
    <li><a class="dropdown-button" href="#!" data-activates="dropdown1"><i class="material-icons">work</i>INVENTARIO
    <i class="material-icons right">arrow_drop_down</i></a></li>
    <li><div class="divider"></div></li>
    <li><a class="dropdown-button" href="#!" data-activates="ddprint"><i class="material-icons">settings</i>PARAMETROS
    <i class="material-icons right">arrow_drop_down</i></a></li>
    <li><div class="divider"></div></li>
    <!-- <li><a href="../inicio/slider.php"><i class="material-icons">web</i>SLIDER</li></a>
    <li><div class="divider"></div></li> -->
    <li><a href="../login/salir.php"><i class="material-icons">power_setting_new</i>SALIR</li></a>
    <li><div class="divider"></div></li>
  </ul>

  <ul id="dropdown1" class="dropdown-content">
    <li><a href="../inventario/index.php">GENERALES</a></li>
    <li><a href="../inventario/index.php?tip=1">PAPELES</a></li>
    <li><a href="../inventario/index.php?tip=2">SUMINISTROS</a></li>
    <li><a href="../inventario/index.php?tip=3">REPUESTOS</a></li>
    <li><a href="../inventario/index.php?tip=4">OTROS</a></li>
   </ul>
   <ul id="ddprint" class="dropdown-content">
     <li><a href="../extend/alerta.php?msj=Página en construcción&c=home&p=in&t=info">GENERAL</a></li>
     <li><a href="../maquinas/index.php">MAQUINAS</a></li>
     <li><a href="../operaciones/index.php">OPERACIONES</a></li>
     <li><a href="../extend/alerta.php?msj=Página en construcción&c=home&p=in&t=info">TIPOS DE TINTA</a></li>
     <li><a href="../enumerados/index.php?tipo=1">AGENCIAS</a></li>
     <li><a href="../enumerados/index.php?tipo=2">TRABAJOS</a></li>

    </ul>
