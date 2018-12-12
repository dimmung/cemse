<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header.php') ?>
<body>

  <img src="<?= base_url('assets/img/divdoc.png')  ?>" alt="divdoc" class="logo-div">
 <img src="<?= base_url('assets/img/cemse.png')  ?>" alt="cemse" class="logo-cemse">

   <br>


 <div class="container-menu">
     <ul class="nav justify-content-center">

       <a class="nav-link " href="<?= base_url('/login/cerrar_sesion') ?>">
       <li class="nav-item">
         Salir
       </li></a>


     </ul>


 </div>
<div class="">

 <div class="col-lg-12"  >
 <body class="fondo">

 <br>
 <br>
  <div class="centrado">
    <?php if ($roles){ ?>


    <?php foreach ($roles as $rol): ?>
  <a href="<?= base_url('/inicio/inicio/'.$rol -> id_juego.'/'.$rol-> id_rol.'/'.$rol-> director); ?>" >    <button type="button" name="button" class="btn btn-rose rol" value="<?= $rol-> id_rol ?>" >  <?=$rol-> nombre_rol ?></button> </a>

    <?php endforeach; ?>
  <?php } else {
    echo "Usted no posee roles asociados para el juego que se encuentra activo";
  } ?>
  </div>

</div>

</div>
<!-- //Modal -->

</body>
<script src="<?= base_url('/assets/js/jquery-3.3.1.min.js')?>"></script>
<script src="<?= base_url('/assets/js/bootstrap.min.js')?>"></script>
<script src="<?= base_url('/assets/DataTables/datatables.min.js')?>"></script>
<script src="<?= base_url('/assets/js/sweetalert2.all.js') ?>"></script>

<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
<script src="<?= base_url('/assets/js/juego.js')?>"></script>


</html>
