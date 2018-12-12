<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO GENÉRICO DE COMUNICADO DE DECISIÓN</b> </p>
  </div>
  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        Clasificación de Unidad
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="clasificacion" name="clasificacion" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>ÓRDENES VERBALES PREVIAS</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="previas"  id="previas" rows="3" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-center">
      <div class="col-md-4">
              <p>EJÉRCITO DE CHILE</p>
      </div>
      <div class="col-md-4">
              <p><b>SECRETO</b> </p>
      </div>
      <div class="col-md-4 junto text-left">
            <textarea name="datos_ejemplar" id="datos_ejemplar" rows="3" class="" ></textarea>
      </div>
  </div>
  <div class="row">
    <div class="col-md-3 offset-md-3 text-right">
        <b><u>COMUNICADO DE DECISIÓN N° </u></b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="row">
    <div class="col-md-2  text-center">
        <b>DEL: </b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="del" name="del" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="row">
    <div class="col-md-2  text-center">
        <b>AL: </b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="al" name="al" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>TEXTO:</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="referencias"  id="referencias" rows="5" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>

  <div class="col-md-4 offset-md-4 text-center">
      <textarea name="firmas"  id="firmas" rows="4" ></textarea>

  </div>

  <button type="submit" class="btn btn-rose btn-sm derecha" id="crear_orden">Crear</button>

</form>


</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script type="text/javascript">
    $("#previas").trumbowyg({
      btns: [
          ['viewHTML'],
          ['undo', 'redo'], // Only supported in Blink browsers
          ['formatting'],
          ['strong', 'em', 'del'],
          ['superscript', 'subscript'],
          ['link'],
          ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
          ['unorderedList', 'orderedList'],
          ['horizontalRule'],
          ['removeformat'],
      ],
      autogrow: true
    });

    $("#datos_ejemplar").trumbowyg({
      btns: [
          ['viewHTML'],
          ['undo', 'redo'], // Only supported in Blink browsers
          ['formatting'],
          ['strong', 'em', 'del'],
          ['superscript', 'subscript'],
          ['link'],
          ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
          ['unorderedList', 'orderedList'],
          ['horizontalRule'],
          ['removeformat'],
      ],
      autogrow: true
    });
    $("#firmas").trumbowyg({
      btns: [
          ['viewHTML'],
          ['undo', 'redo'], // Only supported in Blink browsers
          ['formatting'],
          ['strong', 'em', 'del'],
          ['superscript', 'subscript'],
          ['link'],
          ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
          ['unorderedList', 'orderedList'],
          ['horizontalRule'],
          ['removeformat'],
      ],
      autogrow: true
    });
</script>

</html>
