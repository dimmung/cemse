<?php if ($this->session->has_userdata('id_juego')){
  $ids =  $this->Juego->get_ids($this->session->userdata('id_juego'));?>
  <script type="text/javascript">
    var mapId = <?= $ids-> mapid ?>,
        dummyIcon = { url: '<?= base_url('assets/img/red.png') ?>', width: 70, height: 70 },
        viewer, marker;
    var marker = null;
    var apiKey = '1d6b77813c4e6b8c21ef04a940cd611e';
    var layerId=[<?= $ids-> id_situaciones ?>,<?= $ids-> id_recorridos ?>,<?= $ids-> id_movimiento ?>,<?= $ids-> id_inventario ?> ] ;
    var recorridos= <?= $ids-> id_recorridos ?>;
    var juegoId= <?= $this->session->userdata('id_juego') ?>;
    var rolId= <?= $this->session->userdata('id_rol') ?>;



  </script>
<?php } ?>

 <img src="<?= base_url('assets/img/divdoc.png')  ?>" alt="divdoc" class="logo-div">
<img src="<?= base_url('assets/img/cemse.png')  ?>" alt="cemse" class="logo-cemse">

  <br>
  <div class="datos">
  <p> JUEGO N° <?= $this->session->userdata('id_juego'); ?> - <?= $this->session->userdata('nombre_juego'); ?></p>
  </div>


<div class="container-menu">
    <ul class="nav ">
      <?php if  ($this->session->userdata('administrador') != 't'){ ?>
      <li class="nav-item">
        <a class=" brand" href="<?= base_url('/inicio/index'); ?>"> <b><?= $this->session->userdata('id_rol'); ?> - <?= $this->session->userdata('nombre_rol'); ?></b></a>
      </li>
    <?php } else { ?>
      <li class="nav-item">
        <a class=" brand" href="<?= base_url('/inicio/index'); ?>"> <b>SIMERG</b></a>
      </li>
    <?php } ?>
      <a class="nav-link " href="<?= base_url('/bibliotecas/index'); ?>">
      <li class="nav-item">
        Biblioteca
      </li></a>
      <?php if ($this->session->userdata('administrador') != 't'): ?>
      <a class="nav-link " href="<?= base_url('/ordenes/index'); ?>">
      <li class="nav-item">
        Órdenes
      </li></a>
    <?php endif; ?>
      <?php if ($this->session->userdata('administrador') == 't'): ?>


      <a class="nav-link " href="<?= base_url('/usuarios/index'); ?>">
      <li class="nav-item">
        Usuarios
      </li></a>
      <a class="nav-link " href="<?= base_url('/usuarios/roles'); ?>">
      <li class="nav-item">
        Roles
      </li></a>
        <?php endif; ?>

        <?php if ($this->session->userdata('administrador') != 't'): ?>
          <a class="nav-link " href="<?= base_url('/juegos/hora'); ?>">
          <li class="nav-item">
            Hora
          </li></a>
          <?php endif; ?>

          <?php if ($this->session->userdata('administrador') != 't'): ?>
            <a class="nav-link " href="<?= base_url('/mensajes/recibidos'); ?>">
            <li class="nav-item">
              Mensajeria <span class="badge  badge-pill badge-danger" id="badge"></span>
            </li></a>
            <?php endif; ?>


              <a class="nav-link " href="<?= base_url('/inventarios/index'); ?>">
              <li class="nav-item">
                Inventario
              </li></a>


      <a class="nav-link " href="<?= base_url('/situaciones/index'); ?>">
      <li class="nav-item">
        Situaciones
      </li></a>

      <a class="nav-link " href="<?= base_url('/login/cerrar_sesion') ?>">
      <li class="nav-item">
        Salir
      </li></a>
      <a class="nav-link " href="<?= base_url('/juegos/mapa') ?>" title="Ir al Mapa">
      <li class="nav-item">
        <i class="fas fa-map-marked-alt fa-lg"></i>
      </li></a>
      <a class="  " >
      <li class="actualizar_mapa">
        <i class="fas fa-sync-alt" id="actualizar_mapa" title="Actualizar Recorridos"></i>
      </li></a>
      <a class=" hora_menu " >
      <li>
        <input type="datetime-local" class="form-control-plaintext reloj2" id="date" name="date" readonly title="">
      </li></a>







    </ul>


</div>

<div class="cuerpo" id="cuerpo">
<div class="col-lg-12"  >
<body class="fondo">

<br>
<br>
<link rel="stylesheet" type="text/css" href="<?= base_url('/assets/css/trumbowyg.css') ?>">
<script src="<?= base_url('/assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?= base_url('/assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('/assets/DataTables/datatables.min.js')?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js') ?>"></script>
<script src="<?= base_url('/assets/js/chosen.jquery.js') ?>"></script>
<script src="<?= base_url('/assets/js/init.js') ?>"></script>

<script src="<?= base_url('/assets/js/trumbowyg.js') ?>"></script>
<script type="text/javascript" src="http://api.giscloud.com/1/api.js"></script>

<script type="text/javascript">

var actualizarHora1 = function(){

  // Obtenemos la fecha actual, incluyendo las horas, minutos, segundos, dia de la semana, dia del mes, mes y año;
  var fecha = new Date(),
    nueva = fecha.setHours(fecha.getHours()+<?= $this->session->userdata('hora') ?>),
    horas = fecha.getHours(),
    minutos = fecha.getMinutes(),
    segundos = fecha.getSeconds(),
    diaSemana = fecha.getDay(),
    dia = fecha.getDate(),
    mes = fecha.getMonth()+1,
    year = fecha.getFullYear();
    if (horas < 10){ horas = "0" + horas; };
    if (minutos < 10){ minutos = "0" + minutos; };
    if (segundos < 10){ segundos = "0" + segundos; };
    if (mes < 10){ mes = "0" + mes; };
    if (dia < 10){ dia = "0" + dia; };

  $('#date').val(year+'-'+mes+'-'+dia+'T'+horas+':'+minutos+':'+segundos);
  };
actualizarHora1();
var intervalo1 = setInterval(actualizarHora1, 1000);


 $('#actualizar_mapa').click(function() {
   $( "#actualizar_mapa" ).addClass( "fa-spin" );
   actualizar_map();
   setTimeout(function(){
        setInterval(function(){ actualizar_map(); }, 60000);
     },30000);
 });

 function actualizar_map(){
   var fecha = $('#date').val();
   $.ajax({
     url: baseUrl+"inventarios/avance_unidades/"+fecha,
     success: function(result) {
       giscloud.layers.reset( mapId,  [layerId] );
     }
   })
 }

function mensajes(){
  $.ajax({
    url: baseUrl+"mensajes/get_mensajes/",
    success: function(result) {
      if (result != 0 ) {
        $('#badge').html(result);
      }
    }
  })
}

 $( document ).ready(function() {
   mensajes();
    setInterval(function(){ mensajes(); }, 30000);
 });
</script>
