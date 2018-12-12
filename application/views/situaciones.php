<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>

<?php if ($this->session->userdata('ver') == 1) {
  echo $error;}?>

      <h2 class="text-center"> Situaciones del Juego</h2>

    <table class="table  table-striped " id="situaciones">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Situacion</th>
          <th scope="col"> Tipo </th>
          <th scope="col">Fecha / Hora </th>
          <th scope="col">Estado  </th>


          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php if ($situaciones){  ?>


        <?php foreach ($situaciones as $situacion){ ?>


          <tr>
            <td><?= $situacion -> id_situacion ?></td>
            <td><?= $situacion -> nombre ?></td>
            <td><?= $situacion -> tipo_situacion ?></td>
            <td><?= $situacion -> fecha ?></td>
            <td>
              <?php if ($this->session->userdata('director')== 't' || $this->session->userdata('administrador')== 't')  {
                ?>
                <select id="id_estado_<?=$situacion -> id_situacion?>" name="id_estado" type="text" class="form-control form-control-sm " onchange="actualizar_situacion(<?= $situacion -> id_situacion?>);">
                            <option value="0" selected >Seleccione  Estado</option>
                            <?php
                            foreach($estados as $fila)
                            {
                            ?>
                                <option value="<?= $fila -> id_estado ?>" <?php if ($fila -> id_estado ==  $situacion -> id_estado) { echo "selected";}  ?>  ><?= $fila -> estado ?></option>
                            <?php
                            }
                            ?>
                </select>
                <?php

              } else {
                echo $situacion -> estado;
              }?>





            </td>
            <td class="td_centrado">
              <div class="btn-group btn-group-sm" role="group" aria-label="...">
                  <button type="button" class="btn btn-green"><a onclick="ver_situacion(<?= $situacion -> id_situacion  ?>)" class="blanco" title="Ver Situacion"><i class="far fa-eye "></i></a></button>
                  <button type="button" class="btn btn-danger"><a onclick="eliminar_situacion(<?= $situacion -> id_situacion  ?>)" class="blanco" title="Eliminar Rol"><i class="fas fa-times "></i></a></button>



              </div>
            </td>
          </tr>



        <?php
        }


      } ?>
      </tbody>
    </table>
    <br><br>
    <a href="#"><button type="button" id="crear_sit" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_situacion" onclick="cargarmapa();" style="display:none;">Crear Nuevo </button></a>
    <a href="#"><button type="button" id="ver_sit" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_ver_situacion" onclick="cargarmapa1();" style="display:none;"></button></a>
  </div>
  <br><br>  <br><br>
  <a href="#"><button type="button" id="modal_situacion" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_rol" hidden>Crear Nuevo </button></a>


</div> </div>

</div>
<!-- Modal Crear Situacion-->
<div class="modal fade" id="modal_ver_situacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Ver Situacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div id="situacion1">

        </div>

      </div>
    </div>
  </div>
</div>

<!-- //Modal -->




<!-- Modal Crear Situacion-->
<div class="modal fade" id="modal_crear_situacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Situacion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/situaciones/do_upload'); ?>" id="frm_nueva_situacion" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group  col-md-3">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="" autocomplete="off" required>
            </div>
            <div class="form-group  col-md-4">
              <label for="fecha">Fecha / Hora</label> <br>
              <input type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha"  value="" autocomplete="off" >
             </div>
             <div class="form-group  col-md-3">
               <label for="id_tipo_situacion">Tipo de Situacion</label> <br>
                   <select id="id_tipo_situacion" name="id_tipo_situacion" type="text" class="form-control form-control-sm "  >
                     <option value="0" selected >Seleccione  Tipo</option>
                     <?php
                     foreach($tipos as $fila)
                     {
                     ?>
                         <option value="<?= $fila -> id_tipo_situacion ?>"  ><?= $fila -> tipo_situacion ?></option>
                     <?php
                     }
                     ?>
                   </select>
              </div>
              <div class="form-group  col-md-2">
                <label for="id_estado">Estado</label> <br>
                    <select id="id_estado" name="id_estado" type="text" class="form-control form-control-sm "  >
                      <option value="0" selected >Seleccione  Estado</option>
                      <?php
                      foreach($estados as $fila)
                      {
                      ?>
                          <option value="<?= $fila -> id_estado ?>" <?php if ($fila -> id_estado == 1) { echo "selected";}  ?>  ><?= $fila -> estado ?></option>
                      <?php
                      }
                      ?>
                    </select>
               </div>
          </div>
          <div class="form-row">
            <div class="form-group  col-md-12">
              <label for="descripcion">Descripción</label> <br>
                  <textarea id="descripcion" name="descripcion" type="text" class="form-control form-control-sm"  rows="4"></textarea>
             </div>
          </div>
          <div class="form-row">
            <label for="userfile">Adjunto</label>

          </div>
          <div class="form-row">
            <input type="file" name="userfile" size="20" required />

          </div>
          <br><br>

          <div id="mapViewer">

          </div>
          <br><br>

          <input type="text" class="form-control form-control-sm" id="lat" name="lat"  value="" autocomplete="off" hidden style="display:none;">
          <input type="text" class="form-control form-control-sm" id="lon" name="lon"  value="" autocomplete="off" hidden style="display:none;">
          <div class="form-row">
            <button type="button" class="btn btn-rose btn-sm derecha" id="crear_situacion">Crear</button>
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
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script src="<?= base_url('/assets/js/map.js')?>"></script>

<?php $this->session->set_userdata('ver',0); ?>
</html>
