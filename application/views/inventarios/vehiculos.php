<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
      <h2 class="text-center"> Vehículos</h2>


    <table class="table  table-striped " id="situaciones">
      <thead>
        <tr>
          <th>Tipo de Vehículo</th>
          <th scope="col">Alias</th>
          <th scope="col">Modelo</th>
          <th scope="col">Descripción</th>
          <th scope="col">Capacidad </th>
          <th scope="col">Unidad de Medida </th>
          <th scope="col">Icono</th>
          <th></th>



        </tr>
      </thead>

      <tbody>
        <?php if ($vehiculos){  ?>


        <?php foreach ($vehiculos as $vehiculo){ ?>


         <tr>
            <td><?= $vehiculo -> tipo_elemento ?></td>
            <td><?= $vehiculo -> nombre ?></td>
            <td><?= $vehiculo -> modelo ?></td>
            <td><?= $vehiculo -> descrip ?></td>
            <td><?= $vehiculo -> capacidad ?></td>
            <td><?= $vehiculo -> unidad ?> </td>
            <td><img src="<?= base_url('/iconos/'). $vehiculo -> id_icono. '.png' ?>" alt="" width="50px;" ></td>
            <td><a onclick="editar_vehiculo( <?= $vehiculo -> id_vehiculo  ?>)" class="" title="Editar Vehículo"><i class="fas fa-edit fa-lg"></i></a></td>
          </tr>



        <?php
        }


      } ?>
      </tbody>
    </table>
    <br><br>
    <a href="<?= base_url('/inventarios/nuevo_vehiculo'); ?>"><button type="button" id="" class="btn btn-sm btn-rose" >Crear Nuevo </button></a>
  </div>
  <br><br>  <br>

</div> </div>

</div>


</div>
</body>

<script src="<?= base_url('/assets/js/juego.js')?>"></script>


<?php $this->session->set_userdata('ver',0); ?>
</html>
