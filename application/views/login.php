<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->view('header');
?>
<body class="fondo">
	<img src="<?= base_url('assets/img/divdoc.png')  ?>" alt="divdoc" class="logo-div">
<img src="<?= base_url('assets/img/cemse.png')  ?>" alt="cemse" class="logo-cemse">

		<br>
		<h2 class="titulo">Sistema de Simulación de Emergencias</h2>
<hr class="top">
		<div class="container-login">
    <div class="row">
        <div class="col-md-offset-5 col-md-3">
            <div class="form-login">
            <h4>Bienvenido</h4>
						<br><br>
						<form class="" action="<?=base_url('login/validar') ?>" method="post">

            <input type="text" id="usuario" class="form-control form-control-login  input-sm col-md-10" placeholder="Usuario" name="usuario" />
            </br>
            <input type="password" id="userPassword" class="form-control form-control-login input-sm col-md-10" placeholder="Password" name="clave" />
            </br>
            <div class="wrapper-login">
            <span class="group-btn">
                <button class="btn btn-verde btn-md" type="submit">Login <i class="fas fa-sign-in-alt"></i></button>
          	</form>
            </span>
            </div>
            </div>

		        </div>
		    </div>
		</div>
		<div class="footer text-center fixed-bottom">
			<p>2018 - Ejército de Chile</p>
			<p>Centro de Modelación y Simulación del Ejercito</p>
		</div>


		<script src="<?= base_url('/assets/js/jquery-3.3.1.min.js')?>"></script>
		<script src="<?= base_url('/assets/js/bootstrap.min.js')?>" type="text/javascript" ></script>
		<script src="<?= base_url('/assets/js/sweetalert2.all.js')?>"></script>
		<script src="<?= base_url('/assets/js/login.js')?>"></script>

<?php
		$uri = explode('/',$_SERVER['REQUEST_URI']);
		if (end($uri) === '0') {
			echo '<script> error_credenciales(); </script>';
		} elseif (end($uri) === '1') {
			echo '<script> usuario_bloqueado(); </script>';
		}
?>

</body>
</html>
