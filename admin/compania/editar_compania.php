  <?php include '../extend/header.php';
$id = htmlentities($_GET['id']);
$sel = $con->prepare("SELECT compania FROM compania WHERE id = ?");
$sel -> bind_param('i', $id);
$sel -> execute();
$res = $sel -> get_result();
if ($f =$res->fetch_assoc()) {

}
  ?>
  <div class="row">
    <div class="col s12">
      <div class="card">
        <div class="card-content">
          <span class="card-title">Editar de compañía</span>
          <form class="form" action="up_compania.php" method="post" autocomplete=off >
          <input type="hidden" name="id" value="<?php echo $id?>">
            <div class="input-field">
              <input type="text" name="compania"  title="Solo letras" pattern="[A-Z/s ]+"
              value="<?php echo $f['compania']?>" id="compania" onblur="may(this.value, this.id)">
              <label for="compania">Nombre</label>
            </div>
            <button type="submit" class="btn" >Guardar</button>
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
