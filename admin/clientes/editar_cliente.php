  <?php include '../extend/header.php';
$id = htmlentities($_GET['id']);
$sel = $con->prepare("SELECT id, nombre, direccion, telefono, correo, contacto FROM clientes WHERE id = ?");
$sel -> bind_param('i', $id);
$sel -> execute();
$sel ->bind_result($id, $nombre, $direccion, $telefono, $correo,$contacto);
if ($sel->fetch()) {

}
  ?>
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Editar de clientes</span>
          <form class="form" action="up_clientes.php" method="post" autocomplete=off>
            <input type="hidden" name="id" value="<?php echo $id?>">
            <div class="input-field">
              <input type="text" name="nombre" value="<?php echo $nombre?>" title="Solo letras" pattern="[\p{Latin}/s ]+"  id="nombre" onblur="may(this.value, this.id)"  >
              <label for="nombre">Nombre</label>
            </div>
            <div class="input-field">
              <input type="text" name="direccion" value="<?php echo $direccion?>" id="direccion" onblur="may(this.value, this.id)"  >
              <label for="direccion">Dirección</label>
            </div>
            <div class="input-field">
              <input type="text" name="telefono" value="<?php echo $telefono?>" id="telefono">
              <label for="telefono">Telefono</label>
            </div>
            <div class="input-field">
              <input type="email" name="correo" value="<?php echo $correo?>" id="correo">
              <label for="email">Correo</label>
            </div>
            <div class="input-field">
              <input type="text" name="contacto" value="<?php echo $contacto?>"  title="Solo letras" pattern="[\p{Latin}/s]" id="contacto" onblur="may(this.value, this.id)">
              <label for="contacto">Contacto</label>
            </div>
            <center>
              <button type="submit" class="btn" >Guardar</button>
              <input  type="reset" class="btn red" onclick="window.location='index.php'" value ="Cancelar"</input>
            </center>
          </form>
        </div>
      </div>
    </div>
  </div>
   <?php
   $sel->close();
   $con->close();
   include '../extend/scripts.php' ?>
  </body>
</html>
