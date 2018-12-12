<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
  <div class="menu-mensajeria">
    <table  >
      <td class=" menu-mensajeria-td"> <a href="<?= base_url('/mensajes/recibidos') ?>">Recibidos </a></td>
      <td>|</td>
       <td class="strong-rose menu-mensajeria-td">   Enviados</td>

    </table>
  </div>
      <h2 class="text-center"> Mensajes Enviados</h2>

    <table class="table  table-striped " id="situaciones">
      <thead>
        <tr>
          <th scope="col">Destinatario(s)</th>
          <th scope="col">Situación</th>
          <th scope="col">Asunto</th>
          <th scope="col">Fecha / Hora </th>
          <th scope="col">Adjuntos </th>
          <th scope="col"></th>

        </tr>
      </thead>

      <tbody>

        <?php if ($enviados){  ?>


        <?php foreach ($enviados as $enviado){ ?>
          <?php $Date = date('d-m-Y H:i:s', strtotime($enviado -> fecha)); ?>

          <tr>
            <td><?= $enviado -> receptores ?></td>
            <td><?= $enviado -> nombre ?></td>
            <td><?= $enviado -> asunto ?></td>
            <td><?= $Date ?></td>
            <td><?php if ($enviado -> rutas_ad): ?>
              <i class="fas fa-paperclip"></i>
            <?php endif; ?>
            </td>
            <td><a href="<?= base_url('mensajes/ver/'.$enviado -> id_mensaje) ?>"><i class="fas fa-check-double"></i>></a></td>

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
