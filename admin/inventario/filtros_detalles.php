<?php
$id = htmlentities($_GET['id']);
 ?>
<link rel="stylesheet" href="../css/materialize.min.css" />
<nav class="brown lighten-4" >
  <input type="hidden" id="id" value="<?php echo $id?>">
  <div class="nav-wrapper black-text">
    <div class="row">
      <div class="col s3">
        <div class="input-field">
          <i class="material-icons prefix">date_range</i>
          <input type="date" id="inicio_<?php echo $id?>" class = "datepicker" autocomplete="off" value="2017-01-01">
          <label for="inicio">Fecha Inicio</label>
        </div>
      </div>
      <div class="col s3">
        <div class="input-field">
          <i class="material-icons prefix">date_range</i>
          <input type="date" id="fin_<?php echo $id?>" class = "datepicker" autocomplete="off" value="<?php echo date("Y-m-d")?>">
          <label for="fin">Fecha Final</label>
        </div>
      </div>
      <div class="col s3">
        <select class = "tipo" id="tipo_<?php echo $id?>" name="tipo" required value = "0">
          <option value="0" selected>TODOS</option>
          <option value="1">ENTRADA</option>
          <option value="2">SALIDA</option>
        </select>
      </div>
      <div class="col s3">
        <div class="input-field">
          <i class="material-icons prefix">exposure</i>
          <input type="number" class ="cantidad" name="cantidad" id="cant_<?php echo $id?>" autocomplete="off" value ="10">
          <label for="cantidad">Cantidad Items</label>
        </div>
      </div>
    </div>
  </div>
</nav>
<div class="row">
  <div id = "res_detalle_<?php echo $id?>" class="col s12"/>
  </div>
</div>
<?php include '../extend/scripts.php'; ?>
