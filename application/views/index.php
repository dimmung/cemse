<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

  <img src="<?= base_url('assets/img/divdoc.png')  ?>" alt="divdoc" class="logo-div">
 <img src="<?= base_url('assets/img/cemse.png')  ?>" alt="cemse" class="logo-cemse">

   <br>


 <div class="container-menu">
     <ul class="nav justify-content-center">

       <a class="nav-link " href="<?= base_url('/login/cerrar_sesion') ?>">
       <li class="nav-item">
         Salir
       </li></a>


     </ul>


 </div>
 <div class="cuerpo">
 <div class="col-lg-12"  >
 <body class="fondo">

 <br>
 <br>



  <div>

      <h2 class="text-center"> Lista de Juegos</h2>

    <table class="table  table-striped " id="juegos">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripcion</th>
          <th scope="col">Creado</th>
          <th scope="col">Estado</th>
          <th></th>
        </tr>
      </thead>

      <tbody>
          <?php if ($juegos){  ?>


        <?php foreach ($juegos as $game): ?>
        <tr>
          <td><?= $game -> id_juego ?></td>
          <td><?= $game -> nombre ?></td>
          <td><?= $game -> descripcion ?></td>
          <td><?php
            $date = new DateTime($game -> created_at);
            echo date_format( $date , 'd-m-Y') ?>
          </td>
          <td>
            <select id="id_estado<?=$game -> id_juego?>" name="id_estado" type="text" class="form-control form-control-sm "  onchange="actualizar_juego(<?= $game -> id_juego?>);">
              <option value="0" selected >Seleccione  Estado</option>
              <?php
              foreach($estados as $fila)
              {
              ?>
                  <option value="<?= $fila -> id_estado ?>" <?php if ($fila -> id_estado ==  $game -> id_estado) { echo "selected";}  ?>  ><?= $fila -> estado ?></option>
              <?php
              }
              ?>
            </select>
          </td>
          <td class="td_centrado">
            <div class="btn-group btn-group-sm" role="group" aria-label="...">
                <button type="button" class="btn btn-dark"><a href="<?= base_url('/inicio/inicio/'.$game -> id_juego); ?>" class="blanco" title="Seleccionar"><i class="fas fa-caret-right fa-2x"></i></a></button>
                <button type="button" class="btn btn-rose" onclick="eliminar_juego(<?=$game -> id_juego ?>);"><a class="blanco" title="Seleccionar"><i class="fas fa-times fa-lg"></i></a></button>
            </div>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    <?php } else { ?>

      <td >
        No hay Datos
      </td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>

      <?php
    }?>
    </table>
    <br><br>
    <a href="#"><button type="button" id="" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_usuario">Crear Nuevo </button></a>
  </div>



</div> </div>
<!-- Modal Crear Juego-->
<div class="modal fade" id="modal_crear_usuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Juego</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/juegos/crear'); ?>" id="frm_nuevo_juego" method="post">
          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre " value="" autocomplete="off" required>
            </div>

          </div>


          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">

              <textarea name="descripcion" rows="4" cols="63" placeholder="Descripción"></textarea>
            </div>

          </div>
          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">
              <label for="mapid">ID Mapa</label>
              <input type="number" class="form-control form-control-sm" id="mapid" name="mapid" placeholder="ID Mapa " value="921517" autocomplete="off" required>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">
              <label for="id_situaciones">ID Capa Situaciones</label>
              <input type="number" class="form-control form-control-sm" id="id_situaciones" name="id_situaciones" placeholder="ID Capa Situaciones " value="2496381" autocomplete="off" required>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">
              <label for="id_recorridos">ID Capa Recorridos</label>
              <input type="number" class="form-control form-control-sm" id="id_recorridos" name="id_recorridos" placeholder="ID Capa Recorridos " value="2548632" autocomplete="off" required>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">
              <label for="id_movimiento">ID Capa Inventarios</label>
              <input type="number" class="form-control form-control-sm" id="id_movimiento" name="id_movimiento" placeholder="ID Capa Inventarios " value="2512185" autocomplete="off" required>
            </div>

          </div>

          <div class="form-row">
            <div class="form-group form-control-sm col-md-12">
              <label for="id_inventario">ID Capa Unidades en Movimiento</label>
              <input type="number" class="form-control form-control-sm" id="id_inventario" name="id_inventario" placeholder="ID Capa Situaciones " value="2535257" autocomplete="off" required>
            </div>

          </div>






          <br><br>
          <div class="form-row">
            <button type="button" class="btn btn-rose btn-sm derecha" id="crear_juego">Crear</button>
          </div>

        </form>
      </div>
    </div>
  </div>

<!-- //Modal -->

</body>
<script src="<?= base_url('/assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?= base_url('/assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('/assets/DataTables/datatables.min.js')?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js') ?>"></script>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>


</html>
