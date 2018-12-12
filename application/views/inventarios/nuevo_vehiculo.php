<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
  <form class="" action="<?= base_url('/inventarios/guardar_vehiculo') ?>" method="post">

      <h2 class="text-center">Nuevo Vehículos</h2>
      <br> <br>
      <div class="row">

      <div class="form-group  col-md-3">
        <label for="id_tipo_elemento">Tipo de Vehículo</label> <br>
            <select id="id_tipo_elemento" name="id_tipo_elemento" type="text" class="form-control form-control-sm "  >
              <option value="0" selected >Seleccione  Tipo</option>
              <?php
              foreach($tipos as $fila)
              {
              ?>
                  <option value="<?= $fila -> id_tipo_elemento ?>" title="<?= $fila -> descripcion ?>" ><?= $fila -> tipo_elemento ?></option>
              <?php
              }
              ?>
            </select>
       </div>
       <div class="form-group  col-md-3">
         <label for="nombre">Alias</label>
         <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="" autocomplete="off" required>
       </div>
       <div class="form-group  col-md-3">
         <label for="modelo">Modelo</label>
         <input type="text" class="form-control form-control-sm" id="modelo" name="modelo" placeholder="Modelo" value="" autocomplete="off" required>
       </div>
       <div class="form-group  col-md-3">
         <label for="marca">Marca</label>
         <input type="text" class="form-control form-control-sm" id="marca" name="marca" placeholder="Marca" value="" autocomplete="off" required>
       </div>

      </div>
      <div class="row">
        <div class="form-group  col-md-3">
          <label for="descripcion">Descripción</label>
          <input type="text" class="form-control form-control-sm" id="descripcion" name="descripcion" placeholder="Descripción" value="" autocomplete="off" >
        </div>
        <div class="form-group  col-md-3">
          <label for="capacidad">Capacidad</label>
          <input type="number" class="form-control form-control-sm" id="capacidad" name="capacidad" placeholder="Capacidad" value="" autocomplete="off" required>
        </div>
        <div class="form-group  col-md-3">
          <label for="id_unidad">Unidad de Medida</label> <br>
              <select id="id_unidad" name="id_unidad" type="text" class="form-control form-control-sm "  >
                <option value="0" selected >Seleccione  Unidad</option>
                <?php
                foreach($unidades as $fila)
                {
                ?>
                    <option value="<?= $fila -> id_unidad ?>"><?= $fila -> unidad ?></option>
                <?php
                }
                ?>
              </select>
         </div>
         <div class="form-group  col-md-3">
           <label for="velocidad">Velocidad (Km/h)</label>
           <input type="number" class="form-control form-control-sm" id="velocidad" name="velocidad" placeholder="Velocidad (Km/h)" value="" autocomplete="off" required>
         </div>

    </div>
    <div class="row">
      <div class="form-group  col-md-12">
        <label for="icono">Icono</label> <br>

              <?php
              foreach($iconos as $fila)
              {

              ?>
              <label for="<?= $fila -> id_iconos ?>" class="radio" >
                  <input name="id_icono" type="radio" value="<?= $fila -> id_iconos ?>" id="<?= $fila -> id_iconos ?>">
                  <img src="<?= base_url('/iconos/'). $fila -> icono. '.png' ?>" alt="" width="50px;" >
              </label>

              <?php
              }
              ?>
            </select>


         </div>
    </div>

    <button type="submit" name="button" class="btn btn-rose"> Guardar </button>



</form>

</body>

<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>


<?php $this->session->set_userdata('ver',0); ?>
</html>
