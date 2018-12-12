<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
<form class="" action="<?= base_url('/inventarios/guardar_movimiento') ?>" method="post">
<div class="form-row">


    <div class="form-group  col-md-3">
      <label>Mover Nuevo Elemento</label>
        <select  name="id_inventario" id="id_inventario_mov" type="text" class="form-control form-control-sm " onchange="max();" required >
          <option value="0" selected >Seleccione  un Elemento</option>
          <?php
          foreach($inventario as $fila)
          {
          ?>
              <option value="<?= $fila -> id_inventario ?>" > <?php if ($fila -> id_vehiculo) { echo $fila -> nombre;} else { echo $fila -> elemento;};?> <?php echo " -  Disponible : ".$fila -> disponible ?></option>
          <?php
          }
          ?>
        </select>
    </div>
        <div class="form-group  col-md-2">
          <label for="cantidad">Cantidad</label>
          <input type="number" id="cantidad" name="cantidad" class="text-center form-control form-control-sm"  min="0" disabled required>

        </div>
        <div class="form-group  col-md-3">
          <label>Recorrido</label>
          <select id="id_recorrido" id="id_recorrido" name="id_recorrido" type="text" class="form-control form-control-sm "disabled required >
            <option value="0" selected >Seleccione  Recorrido</option>
            <?php
            foreach($recorridos as $fila)
            {
            ?>
                <option value="<?= $fila -> id_recorrido ?>" title="<?= $fila -> nombre_recorrido ?>"  ><?= $fila -> nombre_recorrido ?></option>
            <?php
            }
            ?>
          </select>
        </div>
        <div class="form-group  col-md-1">
          <label for=""></label>
          <button type="submit" name="button" class="btn btn-rose btn-sm form-control form-control-sm"  id="guardar" style="display:none;"> Guardar</button>

          </div>


</div>
</form>
<br><br>
<h2 class="text-center"> Mover Elementos </h2>

<table class="table  table-striped " id="situaciones">
<thead>
  <tr>
    <th scope="col">Nombre</th>
    <th scope="col">Cantidad </th>
    <th scope="col">Recorrido </th>
    <th scope="col">Estado </th>
    <th scope="col">Hora Salida </th>
    <th scope="col">Hora Llegada </th>
    <th></th>
  </tr>
</thead>

   <tbody>
  <?php if ($elementos){
  foreach ($elementos as $elemento){ ?>
  <tr>
     <td><?php
      if ($elemento -> id_vehiculo) { echo $elemento -> nombre;} else { echo $elemento -> elemento;};?>
   </td>
     <td><?= $elemento -> cantidad1 ?></td>
     <input type="text"  id="cantidad<?= $elemento -> id_inventario_uso ?>" name="" value="<?= $elemento -> cantidad1 ?>" hidden>
     <input type="text"  id="inventario<?= $elemento -> id_inventario_uso ?>" name="" value="<?= $elemento -> id_inventario ?>" hidden>
     <td> <?= $elemento -> nombre_recorrido ?> </td>
     <td class=""><?php if  ($elemento -> id_estado == 1) {
       echo '<i class="far fa-play-circle fa-2x" Title="Iniciar Recorrido" onclick="iniciar_recorrido('.$elemento->id_recorrido.');"></i>';
     }
     if  ($elemento -> id_estado == 2) {
       echo '<i class="fas fa-compact-disc fa-spin fa-2x" Title="Recorrido en proceso"></i>';
     }
     if  ($elemento -> id_estado == 3) {
       echo '<i class="fas fa-flag-checkered fa-2x" title="Recorrido Terminado"></i>';
     }
     if  ($elemento -> id_estado == 4) {
       echo '<i class="far fa-times-circle fa-2x" title="Recorrido Cancelado"></i>';
     } ?> </td>
     <td><?= $elemento -> hora_salida ?></td>
     <td><?= $elemento -> hora_llegada ?></td>
     <td>
        <?php if ($elemento -> id_estado == 1){ ?>
       <a href="<?= base_url('inventarios/agregar_elementos/'.$elemento -> id_inventario_uso)?>"> <i class="far fa-list-alt fa-2x" title="Agregar Elementos al Vehículo"></i></a>
     <?php } else { ?>
      <i class="fas fa-clipboard-check fa-2x" title="Ver Elementos del Vehículo" onclick="ver_elementos(<?= $elemento -> id_inventario_uso ?>)"></i>
     <?php } ?>
       <?php if ($elemento -> id_estado != 4){
       echo '<i class="far fa-times-circle fa-2x" title="Cancelar Recorrido" onclick="cancelar_recorrido('. $elemento -> id_inventario_uso .');"></i>';
     } ?></td>
   </tr>

<?php }

}?>

  </tbody>
</table>
</div>

</div>
<button type="button" id="ver_elementos" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_ver_elementos"  style="display:none;"></button>
<div class="modal fade" id="modal_ver_elementos" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title"> Elementos Asociados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="elementos">

        </div>

      </div>
    </div>
  </div>
</div>

</body>

<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script src="<?= base_url('/assets/js/map_inventario.js')?>"></script>

<?php $this->session->set_userdata('ver',0); ?>
</html>

<script type="text/javascript">
  $('#vehiculo').click(function() {
    $('#id_vehiculo').show();
    $('#elemento').hide();
    $('#cantidad').show();

  });

  $('#otro').click(function() {
    $('#id_vehiculo').hide();
    $('#elemento').show();
    $('#cantidad').show();
  });


  function iniciar_recorrido(id) {
   var fecha = $('#date').val();
    Swal({
      text: '¿Desea iniciar este recorrido? El recorrido Iniciará para todos los elementos asociados al mismo',
      type: 'question',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({

          url: baseUrl+"/inventarios/iniciar_recorrido/"+id+"/"+fecha,
          success: function(result) {
            Swal(
              '¡Éxito!',
              'Recorrido Iniciado con Éxito',
              'success'
            )
            setTimeout(function(){
                location.reload();
               },2000);
          }, error: function(error) {
            Swal(
              'Error',
              'Hubo un fallo al iniciar el Recorrido',
              'error'
            )
          }
        });
      }
    })
  }




  function  max(){
    var id = $('#id_inventario_mov').val();

    $.ajax({

      url: baseUrl+"/inventarios/max/"+id,
      success: function(result) {
        $('#cantidad').attr("max",result);
        $('#cantidad').prop('disabled', false);
        $('#id_recorrido').prop('disabled', false);
        $('#guardar').show();
      }
    });
  }

  function cancelar_recorrido(id) {
    var cantidad = $('#cantidad'+id).val();
    var inventario = $('#inventario'+id).val();
   Swal({
      text: '¿Desea Cancelar este recorrido?',
      type: 'question',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({

          url: baseUrl+"/inventarios/cancelar_recorrido/"+id+"/"+cantidad+"/"+inventario,
          success: function(result) {
            Swal(
              '¡Éxito!',
              'Recorrido Cancelado con Éxito',
              'success'
            )
            setTimeout(function(){
                location.reload();
               },2000);
          }, error: function(error) {
            Swal(
              'Error',
              'Hubo un fallo al cancelar el Recorrido',
              'error'
            )
          }
        });
      }
    })
  }

  function  ver_elementos(id){
    $.ajax({

      url: baseUrl+"/inventarios/ver_elementos/"+id,
      success: function(result) {
        $('#elementos').html(result);
        $('#ver_elementos').click();
      }
    });
  }

</script>
