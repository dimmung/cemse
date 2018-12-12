<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php') ?>

<div class="text-center">

  <?php if ($this->session->userdata('ver') == 1) {
    echo $error;}?>
</div>
  <?php if  ($this->session->userdata('administrador') == 't'){ ?>
  <form action="<?= base_url('bibliotecas/do_upload') ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" class="text-center">

  <input type="text" name="nombre" placeholder="Nombre de Archivo" required/>
  <input type="file" name="userfile" size="20" />
  <input type="submit"  class="btn btn-green btn-sm" value="Subir Archivo" />

  <br /><br />



  </form>

<?php } ?>

        <h2 class="text-center"> Biblioteca del Juego</h2>

      <table class="table  table-striped " id="roles">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Peso</th>

            <th scope="col" class="text-center">Descargar</th>
          </tr>
        </thead>

        <tbody>
          <?php if ($archivos){  ?>


          <?php foreach ($archivos as $archivo){ ?>


            <tr>
              <td><?= $archivo -> id_archivo ?></td>
              <td><?= $archivo -> nombre ?></td>
              <td><?= $archivo -> peso ?> Kb</td>
              <td class="td_centrado">
                <div class="btn-group btn-group-sm" role="group" aria-label="...">
                    <button type="button" class="btn btn-green"><a href="<?= base_url('biblioteca/'.$archivo -> nombre_archivo) ?>" class="blanco" title="Ver / Descargar"><i class="fas fa-download "></i></a></button>
                <?php if  ($this->session->userdata('administrador') == 't'){ ?>
                  <button type="button" class="btn btn-rose" title="Eliminar Orden" onclick="eliminar_archivo(<?=  $archivo -> id_archivo .",'". $archivo -> nombre_archivo."'" ?>);"><i class="fas fa-ban blanco"></i></button>
              <?php } ?>
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
<?php $this->session->set_userdata('ver',0); ?>

</body>
<script type="text/javascript">
$('#roles').DataTable({
  "order": [],
  "language": {
          "url": baseUrl+"assets/DataTables/spanish.json"
      }
  } );
function eliminar_archivo(id,ruta) {
  Swal({
    text: '¿Desea Eliminar este Archivo?',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.value) {
      $.ajax({

        url: baseUrl+"/bibliotecas/eliminar_archivo/"+id+"/"+ruta,
        success: function(result) {
          Swal(
            '¡Éxito!',
            'Archivo Eliminado con Éxito',
            'success'
          )
          setTimeout(function(){
              location.reload();
             },2000);
        }, error: function(error) {
          Swal(
            'Error',
            'Hubo un fallo al eliminar archivo',
            'error'
          )
        }
      });
    }
  })
}
</script>
</html>
