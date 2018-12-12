<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>
<div class="menu-ordenes">
  <table  >
    <td class="menu-mensajeria-td"> <a href="<?= base_url('/ordenes/index') ?>">Mis Ordenes </a></td>
    <td>|</td>
      <td class="strong-rose menu-mensajeria-td">   Compartidas Conmigo</td>

  </table>
</div>
      <h2 class="text-center"> Órdenes </h2>

    <table class="table  table-striped " id="situaciones">
      <thead>
        <tr>
          <th scope="col">N° Orden</th>
          <th scope="col">Tipo de Orden</th>
          <th scope="col"> Título </th>
          <th></th>

        </tr>
      </thead>

      <tbody>
        <?php if ($ordenes){  ?>


        <?php foreach ($ordenes as $orden){ ?>


          <tr>
            <td><?= $orden -> id_orden ?></td>
            <td><?= $orden -> tipo_orden ?></td>
            <td><?= $orden -> titulo ?></td>
            <td class="td_centrado">
              <div class="btn-group btn-group-sm" role="group" aria-label="...">
                  <button type="button" class="btn btn-green"><a href="<?= base_url('/ordenes/ver/'.$orden -> id_orden) ?>" class="blanco" title="Ver Orden"><i class="far fa-eye "></i></a></button>
              </div>
            </td>
          </tr>



        <?php
        }


      } ?>
      </tbody>
    </table>
    <br><br>
    <a href="#"><button type="button" id="crear_orden" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_crear_orden">Crear Nueva </button></a>
  </div>
  <br><br>


</div> </div>

</div>
<!-- Modal Crear Orden-->
<div class="modal fade" id="modal_crear_orden" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
    <div class="modal-content usuario">
      <div class="modal-header">
        <h5 class="modal-title">Crear Orden</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form class="" action="<?= base_url('/ordenes/crear') ?>" method="post">

             <div class="form-group  col-md-12">
               <label for="id_tipo_orden">Tipo de Orden</label> <br>
                   <select id="id_tipo_orden" name="id_tipo_orden" type="text" class="form-control form-control-sm "  >
                     <option value="0" selected >Seleccione  Tipo</option>
                     <?php
                     foreach($tipos as $fila)
                     {
                     ?>
                         <option value="<?= $fila -> id_tipo_orden ?>"  ><?= $fila -> tipo_orden ?></option>
                     <?php
                     }
                     ?>
                   </select>
              </div>
          </div>

          <br><br>

          <div class="form-row">
            <button type="submit" class="btn btn-rose btn-sm derecha" id="crear_orden">Crear</button>
          </div>

        </form>
        <br><br>

      </div>
    </div>
  </div>
</div>

<!-- //Modal -->


</body>


<script src="<?= base_url('/assets/js/juego.js')?>"></script>


<?php $this->session->set_userdata('ver',0); ?>
</html>
