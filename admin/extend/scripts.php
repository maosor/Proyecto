</main>
  <script
			  src="../js/jquery-3.3.1.min.js"
			  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
			  crossorigin="anonymous"></script>

      <script type = "text/javascript" src="../js/sweetalert2.all.js"></script>
      <script src="../js/materialize.min.js"></script>
      <script>
      $('#buscar').keyup(function(event){
        var contenido = new RegExp($(this).val(), 'i'); //i reporesenta sencible a MAYUSCULAS y MINUSCULAS
        $('tr').hide();
        $('tr').filter(function(){
          return contenido.test($(this).text());
        }).show();
        $('.cabecera').attr('Style','');
      });
      $('.button-collapse').sideNav();
      $('select').material_select();
      function may(obj, id) {
        obj = obj.toUpperCase();
        document.getElementById(id).value = obj;
      }
      $('.datepicker').pickadate({
        format:'yyyy-mm-dd',
        selectMonths: true, // Creates a dropdown to control month
        selectYears: 15, // Creates a dropdown of 15 years to control year,
        today: 'Hoy',
        clear: 'Limpiar',
        close: 'Aceptar',
        closeOnSelect: false // Close upon selecting a date,
      });
      $('.tooltipped').tooltip({
        position:'top',
        html: true
      });
      $('#compania').change(function(){
        var compania_activa= $(this).val();
        $.post('../inicio/up_compania_activa.php',
        {
          c:compania_activa
        }, function()
        {
          location.reload();
        });
      });
      </script>
