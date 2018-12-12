<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
      <h2 class="text-center"> Materiales y Personal</h2>


    <table class="table  table-striped " id="situaciones">
      <thead>
        <tr>
          <th>Nombre</th>
          <th></th>



        </tr>
      </thead>

      <tbody>
        <?php if ($materiales){  ?>


        <?php foreach ($materiales as $material){ ?>


         <tr>
            <td><?= $material -> material ?></td>
            <td><a onclick="eliminar_material( <?= $material -> id_material  ?>)" class="btn btn-rose btn-sm blanco derecha" title="Eliminar Elemento"><i class="fas fa-times fa-lg"></i></a></td>
          </tr>



        <?php
        }


      } ?>
      </tbody>
    </table>
    <br><br>
    <a href="#"><button type="button"  class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_situacion" >Crear Nuevo </button></a>
  </div>
  <br><br>  <br>

</div> </div>

</div>
<div class="modal fade" id="modal_crear_situacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered  " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Elemento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?= base_url('/inventarios/guardar_materiales'); ?>" id="frm_nuevo_material" method="post" enctype="multipart/form-data">
          <div class="form-row">
            <div class="form-group  col-md-6">
              <label for="nombre">Nombre</label>
              <input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="" autocomplete="off" required>

            </div>
            <div class="form-group  col-md-4">
              <label for=""> &nbsp;</label>
                <button type="button" class="btn btn-rose btn-sm derecha" id="crear_material">Crear</button>
            </div>
        </div>
        </form>
        <br><br>

      </div>
    </div>
  </div>
</div>

</div>
</body>

<script src="<?= base_url('/assets/js/juego.js')?>"></script>


<?php $this->session->set_userdata('ver',0); ?>
</html>
