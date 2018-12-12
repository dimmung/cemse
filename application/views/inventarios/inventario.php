<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
<div class="form-group  col-md-3">
  <label for="id_rol">Seleccione Rol</label> <br>
      <select id="id_rol" name="id_rol" type="text" class="form-control form-control-sm " onchange="buscar_inventario();"  >
        <option value="0" selected >Seleccione  rol</option>
        <?php

        foreach($roles as $fila)
        {
        ?>
            <option value="<?= $fila -> id_rol ?>" <?php if ($rol == $fila -> id_rol ){ echo "selected";} ?>><?= $fila -> nombre_rol ?></option>
        <?php
        }
        ?>
      </select>
 </div>

 <div id="tablas">

 </div>





    <br><br>



</div></div>

    <!-- Modal Crear Situacion-->
    <div class="modal fade" id="modal_agregar_elemento" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content usuario">
          <div class="modal-header">
            <h5 class="modal-title">Agregar Elemento</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <form action="<?= base_url('/inventarios/guardar_elemento'); ?>" id="frm_nuevo_elemento" method="post" enctype="multipart/form-data">

              <div class="form-row">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="vehiculo" value="1">
                  <label class="form-check-label" for="vehiculo">Vehículo</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="otro" value="2" >
                  <label class="form-check-label" for="otro">Otro</label>
                </div>
              </div>
              <div class="form-row" >
                <div class="form-group  col-md-3" style="display:none;" id="id_vehiculo">
                  <br>
                  <label for="id_vehiculo">Vehículo</label> <br>

                      <select  name="id_vehiculo" type="text" class="form-control form-control-sm "  >
                        <option value="0" selected >Seleccione  Vehículo</option>
                        <?php
                        foreach($vehiculos as $fila)
                        {
                        ?>
                            <option value="<?= $fila -> id_vehiculo ?>" title="<?= $fila -> descrip ?>" ><?= $fila -> nombre ?></option>
                        <?php
                        }
                        ?>
                      </select>
                 </div>
                 <div class="form-group  col-md-3" style="display:none;" id="elemento">
                   <br>
                   <label for="id_material">Elemento</label> <br>
                       <select  name="elemento" type="text" class="form-control form-control-sm "  >
                         <option value="0" selected >Seleccione  Elemento</option>
                         <?php
                         foreach($materiales as $fila)
                         {
                         ?>
                             <option value="<?= $fila -> id_material ?>" title="<?= $fila -> material ?>" ><?= $fila -> material ?></option>
                         <?php
                         }
                         ?>
                       </select>
                  </div>
                 <div class="form-group  col-md-3" style="display:none;" id="cantidad">
                      <br>
                   <label for="cantidad">Cantidad</label>
                   <input type="number" class="form-control form-control-sm"  name="cantidad" placeholder="Cantidad" value="" autocomplete="off" required >
                 </div>
                 <input type="text" name="id_rol_propietario" value="" hidden id="id_rol_propietario">

              </div>
              <br><br>

              <div id="mapViewer">

              </div>
              <br><br>

              <input type="text" class="form-control form-control-sm" id="lat" name="lat"  value="" autocomplete="off" hidden style="display:none;">
              <input type="text" class="form-control form-control-sm" id="lon" name="lon"  value="" autocomplete="off" hidden style="display:none;">
              <div class="form-row">
                <button type="submit" class="btn btn-rose btn-sm derecha" >Crear</button>
              </div>

            </form>
            <br><br>

          </div>
        </div>
      </div>
    </div>

    <!-- //Modal -->
</body>

<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
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

  $( document ).ready(function() {
      buscar_inventario();
  });
</script>
