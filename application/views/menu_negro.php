
 <img src="<?= base_url('assets/img/divdoc.png')  ?>" alt="divdoc" class="logo-div">
<img src="<?= base_url('assets/img/cemse.png')  ?>" alt="cemse" class="logo-cemse">
  <br>


<div class="container-menu">
  <ul class="nav justify-content-center">
    <li class="nav-item">
      <a class=" brand" href="<?= base_url('/inicio/index'); ?>"> <b>CEMSE</b></a>
    </li>
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
            Mensajeria
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


  </ul>


</div>
<div class="cuerpo1">
<div class="col-lg-12"  >
<body class="fondo">

<br>
<br>

<script src="<?= base_url('/assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?= base_url('/assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('/assets/DataTables/datatables.min.js')?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js') ?>"></script>
