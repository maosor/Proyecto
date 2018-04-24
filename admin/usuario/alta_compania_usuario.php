<?php
 include '../extend/header.php';
 include '../extend/permiso.php';
if(isset($_GET['u']))
{
  $usuario = htmlentities($_GET['u']);
}
  if ($_SESSION['nivel'] < 1) {
      $sel = $con->query("SELECT  * FROM compania ");
  }else {
    $quien = $_SESSION['id_usuario'];
    $sel = $con->query("SELECT id, compania FROM usuario_compania uc inner join compania c on uc.id_compania=c.id
    WHERE uc.id_usuario = $quien");
  }
    $row = mysqli_num_rows($sel);
 ?>
   <div class="row ">
       <h5><b>Usuario: </b> </h5>

   </div>
   <div class="row">
     <div class="col s5">
       <div class="card">
         <div class="card-content">
           <span class="card-title">Compañías</span>
           <ul class="collection">
              <?php while ($f = $sel -> fetch_assoc()){ ?>
             <li class="collection-item"><div><?php echo $f['compania']?>
               <a href="" class="agregar secondary-content" id="<?php echo $f['id'] ?>">
                 <i class="material-icons green-text">add</i></a></div></li>
           <?php }
           $sel -> close();
           $sel = $con->query("SELECT id, compania FROM usuario_compania uc inner join compania c on uc.id_compania=c.id
           WHERE uc.id_usuario = $usuario");
           ?>
           </ul>
       </div>
       </div>
     </div>
     <div class="col s2">
       <div class="card">
         <div class="card-title">
         </div>
       </div>
     </div>
     <div class="col s5">
       <input type="hidden" id="id_usuario" value="<?php echo $usuario ?>">
       <div class="card">
         <div class="card-content">
           <span class="card-title">Compañias del usuario</span>
           <ul class="collection">
             <?php while ($f = $sel -> fetch_assoc()){ ?>
             <li class="collection-item"><div><?php echo $f['compania']?><a href="" class="eliminar secondary-content" id = "<?php echo $f['id'] ?>"><i class="material-icons red-text">remove</i></a></div></li>
           <?php } ?>
           </ul>
       </div>
       </div>
     </div>
   </div>
   <div class="row center">
       <input  type="reset" class="btn orange" onclick="window.location='index.php'" value ="Regresar"</input>

   </div>
 <?php include '../extend/scripts.php' ?>
 <script>
 $('.eliminar, .agregar').click(function() {
   if($(this).attr('class').split(" ")[0] == 'eliminar')
     {
       var accion = 'eliminar_compania_usuario.php';
     }
   else if($(this).attr('class').split(" ")[0] == 'agregar'){
     {
       var accion = 'ins_compania_usuario.php';
     }
   }
   $.post(accion,{
     u:$('#id_usuario').val(),
     c:$(this).attr('id'),
     beforeSend: function () {
       $('ul .collection').html('Espere un momento por favor');
      }
    }, function (respuesta) {
         $('ul .collection').html(respuesta);
   });
 });

 </script>
</body>
</html>
