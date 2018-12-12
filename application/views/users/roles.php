<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>


      <h2 class="text-center"> Roles del Juego</h2>

    <table class="table  table-striped " id="roles">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Rol</th>
          <th scope="col">Usuario</th>

          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php if ($roles){  ?>


        <?php foreach ($roles as $rol){ ?>


          <tr>
            <td><?= $rol -> id_rol ?></td>
            <td><?= $rol -> nombre_rol ?></td>
            <td><?= $rol -> usuario ?></td>
            <td class="td_centrado">
              <div class="btn-group btn-group-sm " role="group" aria-label="...">
                  <button type="button" class="btn btn-green"><a onclick="ver_rol(<?= $rol -> id_rol  ?>)" class="blanco" title="Ver Rol"><i class="far fa-eye "></i></a></button>
                  <button type="button" class="btn btn-rose"><a onclick="eliminar_rol(<?= $rol -> id_rol  ?>)" class="blanco" title="Eliminar Rol"><i class="fas fa-times "></i></a></button>
                  <button type="button" class="btn btn-dark"><a href="<?=base_url('inventarios/modificar_inventario/'.$rol -> id_rol ) ?>" class="blanco" title="Inventario"><i class="fas fa-clipboard-list"></i></a></button>



              </div>
            </td>
          </tr>



        <?php
        } ?>
      <?php } else {
        ?>
        <td>No hay Datos</td>
        <td></td>
        <td></td>
        <td></td>


        <?php
      } ?>
      </tbody>
    </table>
    <br><br>
    <a href="#"><button type="button" id="" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_usuario">Crear Nuevo </button></a>
  </div>
  <br><br>  <br><br>
  <a href="#"><button type="button" id="modal_rol" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_ver_rol" hidden>Crear Nuevo </button></a>


</div> </div>

</div>
<!-- Modal Crear Rol-->
<div class="modal fade" id="modal_crear_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/usuarios/crear_rol'); ?>" id="frm_nuevo_rol" method="post">
          <div class="form-row">
            <div class="form-group form-control-sm col-md-6">
              <label for="nombre_rol">Nombre del Rol</label>
              <input type="text" class="form-control form-control-sm" id="nombre_rol" name="nombre_rol" placeholder="Nombre del Rol" value="" autocomplete="off" required>
            </div>
            <div class="form-group  col-md-6">
              <label for="id_usuario">Usuario</label> <br>
                  <select id="id_usuario" name="id_usuario" type="text" class="form-control form-control-sm "  >
                    <option value="0" selected >Seleccione  Usuario</option>
                    <?php
                    foreach($usuarios as $fila)
                    {
                    ?>
                        <option value="<?= $fila -> id_usuario ?>"  ><?= $fila -> nombre_apellido ?></option>
                    <?php
                    }
                    ?>
                  </select>
             </div>
          </div>
          <div class="form-row">
            <div class="form-check form-check-inline">
              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="t" name="director" >
              <label class="form-check-label" for="inlineCheckbox1">Director</label>
            </div>
          </div>

            <h3 class="text-center">Permisos</h3>
          <div class="form-row">
              <div class="text-center">

                  <?php
                  foreach($permisos as $fila)
                  {
                  ?>
                  <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="<?= $fila -> id_permiso ?>" name="permisos[]" checked>
                    <label class="form-check-label" for="inlineCheckbox1"><?= $fila -> descripcion ?></label>
                  </div>
                  <?php
                  }
                  ?>

            </div>
          </div>



          <div class="form-row">
            <button type="button" class="btn btn-rose btn-sm derecha" id="crear_rol">Crear</button>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>

<!-- //Modal -->




<!-- Modal Crear Rol-->
<div class="modal fade" id="modal_ver_rol" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Rol</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="" id="cuerpo_modal">

        </div>
      </div>
    </div>
  </div>
</div>

<!-- //Modal -->

</body>


<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>

</html>
