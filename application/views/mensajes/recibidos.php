<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
  <div class="menu-mensajeria">
    <table  >
      <td class="strong-rose menu-mensajeria-td">Recibidos</td>
      <td>|</td>
        <td class="menu-mensajeria-td"> <a href="<?= base_url('/mensajes/enviados') ?>">  Enviados </a></td>

    </table>
  </div>
      <h2 class="text-center"> Mensajes Recibidos</h2>

    <table class="table  table-striped " id="situaciones">
      <thead>
        <tr>
          <th scope="col">Remitente</th>
          <th scope="col">Situación</th>
          <th scope="col">Asunto</th>
          <th scope="col">Fecha / Hora </th>
          <th scope="col">Adjuntos </th>
          <th></th>


        </tr>
      </thead>

      <tbody>
        <?php if ($recibidos){  ?>


        <?php foreach ($recibidos as $recibido){ ?>
          <?php $Date = date('d-m-Y H:i:s', strtotime($recibido -> fecha)); ?>

         <tr <?php if ($recibido -> visto == 1){ echo "class='strong'"; }; ?>>

            <td><?= $recibido -> remitente ?></td>
            <td><?= $recibido -> nombre ?></td>
            <td><?= $recibido -> asunto ?></td>
            <td><?= $Date ?></td>
            <td><?php if ($recibido -> rutas_ad): ?>
              <i class="fas fa-paperclip"></i>
            <?php endif; ?></td>
            <td><a href="<?= base_url('mensajes/ver/'.$recibido -> id_mensaje) ?>"><?php if ($recibido -> visto == 1){ echo  '<i class="fas fa-envelope"></i>';} else { echo '<i class="fas fa-envelope-open-text"></i>';} ?>

          </a></td>

          </tr>



        <?php
        }


      } ?>
      </tbody>
    </table>
    <br><br>
    <a href="<?= base_url('/mensajes/nuevo'); ?>"><button type="button" id="" class="btn btn-sm btn-rose" >Crear Nuevo </button></a>
  </div>
  <br><br>  <br>

</div> </div>

</div>


</body>

<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script src="<?= base_url('/assets/js/map.js')?>"></script>

<?php $this->session->set_userdata('ver',0); ?>
</html>
