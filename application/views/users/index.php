<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>


  <div>

      <h2 class="text-center"> Lista de Usuarios Seleccionados para este Juego</h2>

    <table class="table  table-striped " id="usuarios_juego">
      <thead>
        <tr>
          <th scope="col">RUT</th>
          <th scope="col">Usuario</th>
          <th scope="col">Nombre Apellido</th>
          <th scope="col">Creado</th>
          <th scope="col">Activo</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
        <?php if ($usuarios_x_juego){  ?>

        <?php foreach ($usuarios_x_juego as $user): ?>
        <tr>
          <td><?= $user -> id_usuario ?></td>
          <td><?= $user -> usuario ?></td>
          <td><?= $user -> nombre_apellido ?></td>
          <td><?php
            $date = new DateTime($user -> created_at);
            echo date_format( $date , 'd-m-Y') ?>
          </td>
          <td><?php
            if ($user -> is_active == 't'){
              echo "SI";
            } else {
              echo "NO";
            }?>
          </td>
          <td class="td_centrado">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
              <!-- <button type="button" class="btn btn-secondary"><a href="<?php //base_url('/usuarios/ver_perfil/'.$user -> id_usuario); ?>" class="blanco" title="Ver Perfil"><i class="fas fa-user "></i></a></button> -->
              <!-- <button type="button" class="btn btn-dark"><a href="#" class="blanco" title="Restablecer Clave" onclick="restablecer_clave(<?= $user->id_usuario ?>);"><i class="fas fa-key"></i></a></button> -->

                <button type="button" class="btn btn-danger"><a onclick="eliminar_usuario(<?=$user -> id_usuario ?>)" class="blanco" title="Remover Usuario del Juego"><i class="fas fa-times"></i></a></button>

            </div>
          </td>
        </tr>
      <?php endforeach; }?>
      </tbody>
    </table>
    <br><br>


<br><br><br>








  <div>

      <h2 class="text-center"> Lista de Usuarios del Sistema</h2>

    <table class="table  table-striped " id="usuarios">
      <thead>
        <tr>
          <th scope="col">RUT</th>
          <th scope="col">Usuario</th>
          <th scope="col">Nombre Apellido</th>
          <th scope="col">Creado</th>
          <th scope="col">Activo</th>
          <th></th>
        </tr>
      </thead>

      <tbody>

        <?php foreach ($usuarios as $user){ ?>


          <tr>
            <td><?= $user -> id_usuario ?></td>
            <td><?= $user -> usuario ?></td>
            <td><?= $user -> nombre_apellido ?></td>
            <td><?php
              $date = new DateTime($user -> created_at);
              echo date_format( $date , 'd-m-Y') ?>
            </td>
            <td><?php
              if ($user -> is_active == 't'){
                echo "SI";
              } else {
                echo "NO";
              }?>
            </td>
            <td class="td_centrado">
              <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <!-- <button type="button" class="btn btn-secondary"><a href="<?php //base_url('/usuarios/ver_perfil/'.$user -> id_usuario); ?>" class="blanco" title="Ver Perfil"><i class="fas fa-user "></i></a></button> -->
                <!-- <button type="button" class="btn btn-dark"><a href="#" class="blanco" title="Restablecer Clave" onclick="restablecer_clave(<?= $user->id_usuario ?>);"><i class="fas fa-key"></i></a></button> -->
                <?php if ($user-> is_active == 't'){ ?>
                  <button type="button" class="btn btn-dark"><a href="<?= base_url('/usuarios/bloquear/'.$user -> id_usuario); ?>" class="blanco" title="Bloquear"><i class="fas fa-lock "></i></a></button>
                <?php }else{ ?>
                  <button type="button" class="btn btn-dark"><a href="<?= base_url('/usuarios/desbloquear/'.$user -> id_usuario); ?>" class="blanco" title="Desbloquear"><i class="fas fa-lock-open "></i></a></button>
                <?php } ?>
                <button type="button" class="btn btn-green"><a  class="blanco" title="Agregar al juego" onclick="agregar_usuario(<?=$user -> id_usuario ?>)"><i class="fas fa-plus"></i></a></button>
              </div>
            </td>
          </tr>



        <?php } ?>

      </tbody>
    </table>
    <br><br>
    <a href="#"><button type="button" id="" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_usuario">Crear Nuevo </button></a>
  </div>
  <br><br>  <br><br>


</div> </div>

</div>
<!-- Modal Crear Usuario-->
<div class="modal fade" id="modal_crear_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Usuario</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/usuarios/crear'); ?>" id="frm_nuevo_usuario" method="post">
          <div class="form-row">
            <div class="form-group form-control-sm col-md-6">
              <label for="rut">RUT</label>
              <input type="number" class="form-control form-control-sm" id="rut" name="rut" placeholder="RUT sin letras ni guiones" value="" autocomplete="off" required title="Introduzca RUT sin letras ni guiones">
            </div>

              <div class="form-group form-control-sm col-md-6">
                <label for="nombre_apellido">Nombre y Apellido</label>
                <input type="nombre_apellido" class="form-control form-control-sm" id="nombre_apellido" name="nombre_apellido" placeholder="Ingrese Nombre y Apellido" value="" autocomplete="off" required>
              </div>

          </div>


          <div class="form-row">
            <div class="form-group form-control-sm col-md-6">
              <label for="usuario">Usuario</label>
              <input type="text" class="form-control form-control-sm" id="usuario" name="usuario" placeholder="Username" value="" required autocomplete="off">
            </div>
            <div class="form-group form-control-sm col-md-6">
              <label for="clave">Password</label>
              <input type="password" class="form-control form-control-sm" id="clave" name="clave" placeholder="Password" value="" required autocomplete="off">
            </div>
          </div>
          <div class="form-row">

            <div class="custom-control custom-checkbox form-group form-control-sm offset-md-1 col-md-5 " style="margin-top:4%;">
              <input type="checkbox" class="custom-control-input" id="customCheck1" name="administrador" value="t">
              <label class="custom-control-label" for="customCheck1" style="margin-left:10%;" > Administrador</label>
            </div>
            <div class="form-group form-control-sm col-md-6 ">
              <label for="clave1">Confirmar Password</label>
              <input type="password" class="form-control form-control-sm" id="clave1" name="clave1" placeholder="Confirmar Password" value="" required autocomplete="off">
            </div>
          </div>





          <br><br>
          <div class="form-row">
            <button type="button" class="btn btn-rose btn-sm derecha" id="crear">Crear</button>
          </div>

        </form>
      </div>
    </div>
  </div>

<!-- //Modal -->

</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>

</html>
