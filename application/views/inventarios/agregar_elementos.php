<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
<form class="" action="<?= base_url('/inventarios/guardar_elemento_inv') ?>" method="post">
<div class="form-row">

    <div class="form-group  col-md-3">
      <label>Agregar Elemento a Vehículo</label>
        <select  name="id_inventario" id="id_inventario_mov" type="text" class="form-control form-control-sm " onchange="max();" required >
          <option value="0" selected >Seleccione  un Elemento</option>
          <?php
          foreach($materiales as $fila)
          {
          ?>
              <option value="<?= $fila -> id_inventario ?>"> <?= $fila -> material  ?>  -  Disponible : <?=   $fila -> disponible ?> </option>
          <?php
          }
          ?>
        </select>
    </div>
        <div class="form-group  col-md-2">
          <label for="cantidad">Cantidad</label>
          <input type="number" id="cantidad" name="cantidad" class="text-center form-control form-control-sm"  min="0" disabled required>

        </div>

        <div class="form-group  col-md-1">
          <label for="">&nbsp;</label>
          <button type="submit" name="button" class="btn btn-rose btn-sm form-control form-control-sm"  id="guardar" style="display:none;" value="<?= $id_inventario_uso ?>"> Guardar</button>

          </div>


</div>
</form>
<br><br>
<h2 class="text-center"> Elementos en Vehículo </h2>

<table class="table  table-striped " id="situaciones">
<thead>
  <tr>
    <th scope="col">Nombre</th>
    <th scope="col">Cantidad </th>

    <th></th>
  </tr>
</thead>

   <tbody>
  <?php if ($elementos){
  foreach ($elementos as $elemento){ ?>
  <tr>
     <td><?= $elemento -> material?>
   </td>
     <td><?= $elemento -> cantidad ?></td>
     <input type="text"  id="cantidad<?= $elemento -> id_unidad ?>" name="" value="<?= $elemento -> cantidad ?>" hidden>
     <input type="text"  id="inventario<?= $elemento -> id_unidad ?>" name="" value="<?= $elemento -> id_material ?>" hidden>
     <td><i class="far fa-times-circle fa-2x" title="Eliminar Elemento" onclick="cancelar_recorrido(<?= $elemento -> id_unidad ?>);"></i></td>
   </tr>

<?php }

}?>

  </tbody>
</table>


</body>

<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script src="<?= base_url('/assets/js/map_inventario.js')?>"></script>

<?php $this->session->set_userdata('ver',0); ?>
</html>

<script type="text/javascript">


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
      text: '¿Desea Eliminar este elemento del recorrido?',
      type: 'question',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({

          url: baseUrl+"/inventarios/cancelar_elemento/"+id+"/"+cantidad+"/"+inventario,
          success: function(result) {
            Swal(
              '¡Éxito!',
              'Elemento Elimado con Éxito',
              'success'
            )
            setTimeout(function(){
                location.reload();
               },2000);
          }, error: function(error) {
            Swal(
              'Error',
              'Hubo un fallo al eliminar el elemento',
              'error'
            )
          }
        });
      }
    })
  }



</script>
