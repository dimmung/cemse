<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

<?php $this->view('menu.php'); ?>
<form id="frm-apreciacion" action="<?= base_url('ordenes/guardar'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" >

  <div class="col-md-4 offset-md-4 text-center">
    <p><b>FORMATO GENÉRICO DE ORGANIZACIÓN DE TAREA</b> </p>
  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-md-3 text-right">
        ORGANIZACIÓN DE TAREA DE LA
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="titulo" name="titulo" value="" autocomplete="off" placeholder="">
      </div>

  </div>
  <br>
  <br>
  <div class="row">
    <div class="col-md-2  text-right">
        <b>DEL: </b>
    </div>
      <div class="col-md-3 ">
        <input type="text" class="form-control form-control-sm" id="del" name="del" value="" autocomplete="off" placeholder="">
      </div>
      <div class="col-md-2  text-center">
          <b>AL: </b>
      </div>
        <div class="col-md-3 ">
          <input type="text" class="form-control form-control-sm" id="al" name="al" value="" autocomplete="off" placeholder="">
        </div>

  </div>
  <br>
<br>
  <div class="form-group row ">
      <div class="col-md-2">
              <p><b>1.UNIDAD DE MANDO Y CONTROL</b></p>
      </div>
      <div class="col-md-10 text-left ">
              <textarea name="referencias"  id="referencias" rows="5" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>
  <div class="form-group row text-right">
      <div class="col-md-2">
              <p><b>2.UNIDADES SUBORDINADAS</b></p>
      </div>
      <div class="col-md-10 text-left">
              <textarea name="mision"  id="mision" rows="5" class="textarea-lg"></textarea>
      </div>
  </div>
  <br>

  <div class="col-md-4 offset-md-4 text-center">

            <p><b>FIRMA</b></p>

      <textarea name="firmas"  id="firmas" rows="4" ></textarea>

  </div>

  <button type="submit" class="btn btn-rose btn-sm derecha" id="crear_orden">Crear</button>

</form>


</body>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/usuario.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>
<script type="text/javascript">
    $("#mision").trumbowyg({
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

    $("#referencias").trumbowyg({
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
