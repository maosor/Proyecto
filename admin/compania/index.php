<?php include '../extend/header.php'; ?>

<div class="row">
  <div class="col s12">
    <div class="card">
      <div class="card-content">
        <span class="card-title">Mantenimiento de compañias</span>
        <form class="form" action="ins_compania.php" method="post" autocomplete=off >
          <div class="input-field">
            <input type="text" name="compania"  title="Solo letras" pattern="[\p{Latin}/s ]+"  id="compania" onblur="may(this.value, this.id)"  >
            <label for="nombre">Nombre compañia</label>
          </div>
          <button type="submit" class="btn" >Guardar nueva</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col s12">
    <nav class="brown lighten-3" >
      <div class="nav-wrapper">
        <div class="input-field">
          <input type="search"   id="buscar" autocomplete="off"  >
          <label for="buscar"><i class="material-icons" >search</i></label>
          <i class="material-icons" >close</i>
        </div>
      </div>
    </nav>
  </div>
</div>

<?php
$sel= $con->prepare("SELECT id, compania FROM compania ");
$sel -> execute();
$sel -> bind_result($id, $compania);
$sel -> store_result();
$row = $sel->num_rows;
 ?>
 <div class="row">
   <div class="col s12 ">
     <div class="card">
       <div class="card-content">
         <span class="card-title">Compañias(<?php echo $row?>)</span>
         <table>
           <thead>
             <tr class="cabecera">
               <th>Nombre</th>
               <th></th>
               <th></th>
             </tr>
           </thead>
           <?php while ($sel->fetch()) { ?>
            <tr>
              <td><?php echo $compania?></td>
              <td> <a href="editar_compania.php?id=<?php echo $id?>" class="btn-floating blue"> <i class="material-icons">edit</i></a>
              </td>
              <td>
                <a href="#" class="btn-floating red" onclick="swal({title: '¿Esta seguro que desea eliminar la compañía?',text: 'Al eliminarla no podrá recuperarla!',
                  type: 'warning',showCancelButton: true, confirmButtonColor: '#3085d6', cancelButtonColor: '#d33', confirmButtonText: 'Si, Eliminarla'
                }).then((result) => { if (result.value){location.href='eliminar_compania.php?id=<?php echo $id?>';}})"><i class="material-icons">clear</i></a>
              </td>
            </tr>
          <?php }
          $sel->close();
          $con->close();
           ?>
         </table>
       </div>
     </div>
   </div>
 </div>
<?php include '../extend/scripts.php'; ?>

</body>
</html>
