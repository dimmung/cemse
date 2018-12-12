<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->view('header');
require_once ("menu_negro.php");
?>


<div class="wrap">
		<div class="widget">

			<div class="fecha">
        <p>Fecha / Hora Actual</p>
        <br>
				<p id="diaSemana" class="diaSemana"></p>
				<p id="dia" class="dia"></p>
				<p>de </p>
				<p id="mes" class="mes"></p>
				<p>del </p>
				<p id="year" class="year">2015</p>
			</div>

			<div class="reloj">
				<p id="horas" class="horas"></p>
				<p>:</p>
				<p id="minutos" class="minutos"></p>
				<p>:</p>
				<div class="caja-segundos">
					<p id="ampm" class="ampm"></p>
					<p id="segundos" class="segundos"></p>
				</div>
			</div>
		</div>
</div>

<div class="wrap1">
		<div class="widget">

			<div class="fecha">
        <p>Fecha / Hora Táctica</p>
        <br>
				<p id="diaSemana1" class="diaSemana"></p>
				<p id="dia1" class="dia"></p>
				<p>de </p>
				<p id="mes1" class="mes"></p>
				<p>del </p>
				<p id="year1" class="year">2015</p>
			</div>

			<div class="reloj">
				<p id="horas1" class="horas"></p>
				<p>:</p>
				<p id="minutos1" class="minutos"></p>
				<p>:</p>
				<div class="caja-segundos">
					<p id="ampm1" class="ampm"></p>
					<p id="segundos1" class="segundos"></p>
				</div>
			</div>
		</div>
</div>
<?php if ($this->session->userdata('director')== 't'): ?>


<div class="wrap2">
  <form class="" action="<?= base_url('juegos/actualizar_hora') ?>" method="post">
    <div class="form-group ">
			<label for="">Diferencia en Horas &nbsp;&nbsp;</label>
      <input type="number" name="h_tactica" value="<?= $this->session->userdata('hora')?>" required/>
      <input type="submit"  class="btn btn-rose btn-sm" value="Guardar" />

	  </form>
	</div>

</div>
<?php endif; ?>

</body>
</html>
<script src="<?= base_url('assets/js/Chart.bundle.js')?>" charset="utf-8"></script>
<script type="text/javascript">
(function(){

var actualizarHora = function(){
  // Obtenemos la fecha actual, incluyendo las horas, minutos, segundos, dia de la semana, dia del mes, mes y año;
  var fecha = new Date(),
    nueva = fecha.setHours(fecha.getHours()),
    horas = fecha.getHours(),
    ampm,
    minutos = fecha.getMinutes(),
    segundos = fecha.getSeconds(),
    diaSemana = fecha.getDay(),
    dia = fecha.getDate(),
    mes = fecha.getMonth(),
    year = fecha.getFullYear();

  // Accedemos a los elementos del DOM para agregar mas adelante sus correspondientes valores
  var pHoras = document.getElementById('horas'),
    pAMPM = document.getElementById('ampm'),
    pMinutos = document.getElementById('minutos'),
    pSegundos = document.getElementById('segundos'),
    pDiaSemana = document.getElementById('diaSemana'),
    pDia = document.getElementById('dia'),
    pMes = document.getElementById('mes'),
    pYear = document.getElementById('year');


  // Obtenemos el dia se la semana y lo mostramos
  var semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
  pDiaSemana.textContent = semana[diaSemana];

  // Obtenemos el dia del mes
  pDia.textContent = dia;

  // Obtenemos el Mes y año y lo mostramos
  var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
  pMes.textContent = meses[mes];
  pYear.textContent = year;

  // Cambiamos las hora de 24 a 12 horas y establecemos si es AM o PM

  if (horas >= 12) {
    horas = horas - 12;
    ampm = 'PM';
  } else {
    ampm = 'AM';
  }

  // Detectamos cuando sean las 0 AM y transformamos a 12 AM
  if (horas == 0 ){
    horas = 12;
  }

  // Si queremos mostrar un cero antes de las horas ejecutamos este condicional
  // if (horas < 10){horas = '0' + horas;}
  pHoras.textContent = horas;
  pAMPM.textContent = ampm;

  // Minutos y Segundos
  if (minutos < 10){ minutos = "0" + minutos; }
  if (segundos < 10){ segundos = "0" + segundos; }

  pMinutos.textContent = minutos;
  pSegundos.textContent = segundos;
};

actualizarHora();
var intervalo = setInterval(actualizarHora, 1000);
}())




var actualizarHora1 = function(){
  // Obtenemos la fecha actual, incluyendo las horas, minutos, segundos, dia de la semana, dia del mes, mes y año;
  var fecha = new Date(),
    nueva = fecha.setHours(fecha.getHours()+<?= $this->session->userdata('hora') ?>),
    horas = fecha.getHours(),
    ampm,
    minutos = fecha.getMinutes(),
    segundos = fecha.getSeconds(),
    diaSemana = fecha.getDay(),
    dia = fecha.getDate(),
    mes = fecha.getMonth(),
    year = fecha.getFullYear();

  // Accedemos a los elementos del DOM para agregar mas adelante sus correspondientes valores
  var pHoras = document.getElementById('horas1'),
    pAMPM = document.getElementById('ampm1'),
    pMinutos = document.getElementById('minutos1'),
    pSegundos = document.getElementById('segundos1'),
    pDiaSemana = document.getElementById('diaSemana1'),
    pDia = document.getElementById('dia1'),
    pMes = document.getElementById('mes1'),
    pYear = document.getElementById('year1');


  // Obtenemos el dia se la semana y lo mostramos
  var semana = ['Domingo', 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado'];
  pDiaSemana.textContent = semana[diaSemana];

  // Obtenemos el dia del mes
  pDia.textContent = dia;

  // Obtenemos el Mes y año y lo mostramos
  var meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre']
  pMes.textContent = meses[mes];
  pYear.textContent = year;

  // Cambiamos las hora de 24 a 12 horas y establecemos si es AM o PM

  if (horas >= 12) {
    horas = horas - 12;
    ampm = 'PM';
  } else {
    ampm = 'AM';
  }

  // Detectamos cuando sean las 0 AM y transformamos a 12 AM
  if (horas == 0 ){
    horas = 12;
  }

  // Si queremos mostrar un cero antes de las horas ejecutamos este condicional
  // if (horas < 10){horas = '0' + horas;}
  pHoras.textContent = horas;
  pAMPM.textContent = ampm;

  // Minutos y Segundos
  if (minutos < 10){ minutos = "0" + minutos; }
  if (segundos < 10){ segundos = "0" + segundos; }

  pMinutos.textContent = minutos;
  pSegundos.textContent = segundos;
};

actualizarHora1();
var intervalo1 = setInterval(actualizarHora1, 1000);

</script>

</script>
