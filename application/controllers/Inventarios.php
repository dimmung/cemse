<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventarios extends CI_Controller {

	public function __construct() {
		parent::__construct();
    $this->load->model('Inventario');
		$this->load->model('Usuario');
		$this->load->model('Juego');
	}


  public function index() {

		if ($this->session->has_userdata('id') ){
			 $data['vehiculos'] = $this->Inventario->get_vehiculos();
			 $this->load->view('inventarios/index_inventario',$data);

		} else {
			redirect(base_url('/login/index/'));
		}
	}

	public function vehiculos() {

		if ($this->session->has_userdata('id') ) {
			 $data['vehiculos'] = $this->Inventario->get_vehiculos();
			 $this->load->view('inventarios/vehiculos',$data);

		} else {
			redirect(base_url('/login/index/'));
		}
	}

	public function materiales() {

		if ($this->session->has_userdata('id') ) {
			 $data['materiales'] = $this->Inventario->get_materiales();
			 $this->load->view('inventarios/materiales',$data);

		} else {
			redirect(base_url('/login/index/'));
		}
	}

	public function guardar_materiales(){

			$datos['material'] = $this->input->post('nombre');
			$this->Inventario->guardar_materiales($datos);

		redirect(base_url('/inventarios/materiales/'));
	}


	public function nuevo_vehiculo() {

		if ($this->session->has_userdata('id')) {
			 $data['tipos'] = $this->Inventario->get_tipos_v();
			 $data['unidades'] = $this->Inventario->get_unidades();
			 $data['iconos'] = $this->Inventario->get_iconos();
			 $this->load->view('inventarios/nuevo_vehiculo',$data);

		} else {
			redirect(base_url('/login/index/'));
		}
	}

	public function guardar_vehiculo(){
		if ($this->input->post('nombre')) {
				$datos['nombre'] = $this->input->post('nombre');
			}

		if ($this->input->post('modelo')) {
				$datos['modelo'] = $this->input->post('modelo');
			}
		if ($this->input->post('marca')) {
				$datos['marca'] = $this->input->post('marca');
			}

		if ($this->input->post('descripcion')) {
				$datos['descripcion'] = $this->input->post('descripcion');
			}

		if ($this->input->post('capacidad')) {
				$datos['capacidad'] = $this->input->post('capacidad');
			}

		if ($this->input->post('capacidad')) {
				$datos['capacidad'] = $this->input->post('capacidad');
			}

		if ($this->input->post('id_unidad')) {
				$datos['id_unidad'] = $this->input->post('id_unidad');
			}

		if ($this->input->post('id_icono')) {
				$datos['id_icono'] = $this->input->post('id_icono');
			}

		if ($this->input->post('id_tipo_elemento')) {
 			 $datos['id_tipo_elemento'] = $this->input->post('id_tipo_elemento');
 		 }
		 if ($this->input->post('velocidad')) {
  			 $datos['velocidad'] = $this->input->post('velocidad');
  		 }

		$this->Inventario->guardar_vehiculo($datos);

		redirect(base_url('/inventarios/vehiculos/'));
	}

	public function editar_vehiculo($id){
		if ($this->session->has_userdata('id') && $this->session->userdata('administrador') == 't') {
				$data['datos'] = $this->Inventario->get_vehiculo($id);
				$data['tipos'] = $this->Inventario->get_tipos_v();
				$data['unidades'] = $this->Inventario->get_unidades();
				$data['iconos'] = $this->Inventario->get_iconos();
				$this->load->view('inventarios/editar_vehiculo',$data);

			} else {
				redirect(base_url('/login/index/'));
			}
	}

	public function actualizar_vehiculo(){

		$id = $this->input->post('id_vehiculo');

		if ($this->input->post('nombre')) {
				$datos['nombre'] = $this->input->post('nombre');
			}

		if ($this->input->post('modelo')) {
				$datos['modelo'] = $this->input->post('modelo');
			}
		if ($this->input->post('marca')) {
				$datos['marca'] = $this->input->post('marca');
			}

		if ($this->input->post('descripcion')) {
				$datos['descripcion'] = $this->input->post('descripcion');
			}

		if ($this->input->post('capacidad')) {
				$datos['capacidad'] = $this->input->post('capacidad');
			}

		if ($this->input->post('capacidad')) {
				$datos['capacidad'] = $this->input->post('capacidad');
			}

		if ($this->input->post('id_unidad')) {
				$datos['id_unidad'] = $this->input->post('id_unidad');
			}

		if ($this->input->post('id_icono')) {
				$datos['id_icono'] = $this->input->post('id_icono');
			}

		if ($this->input->post('id_tipo_elemento')) {
			 $datos['id_tipo_elemento'] = $this->input->post('id_tipo_elemento');
		 }
		 if ($this->input->post('velocidad')) {
  			 $datos['velocidad'] = $this->input->post('velocidad');
  		 }

		$this->Inventario->actualizar_vehiculo($datos,$id);

		redirect(base_url('/inventarios/vehiculos/'));
	}

	function modificar_inventario($id=null) {
		$data['roles'] = $this->Usuario->get_roles($this->session->userdata('id_juego'));
		$data['vehiculos'] = $this->Inventario->get_vehiculos();
		$data['materiales'] = $this->Inventario->get_materiales();
		$data['rol'] = $id;
		$this->load->view('inventarios/inventario',$data);
	}

	function buscar_inventario($id){
		$elementos = $this->Inventario->get_inventario($id);
		echo ' <h2 class="text-center"> Elementos </h2>

	<table class="table  table-striped " id="situaciones">
		<thead>
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Cantidad </th>
				<th scope="col">Vehículo </th>





			</tr>
		</thead>

		<tbody>';

			 if ($elementos){

			 foreach ($elementos as $elemento){
      echo "

			 <tr>
					<td>";

					 if ($elemento -> id_vehiculo) { echo $elemento -> nombre;} else { echo $elemento -> material;};

					 echo "</td>
					<td>". $elemento -> cantidad ."</td>
					<td>";
					 if ($elemento -> id_vehiculo) { echo 'SI';	} else { echo 'NO';}
					echo " </td>
				</tr>
				" ;




			}


		}
		echo '</tbody>
	</table>
<button type="button" id="crear_sit" class="btn btn-sm btn-rose" data-toggle="modal" data-target="#modal_agregar_elemento" onclick="cargarmapa();" >Agregar Nuevo </button>
	';

		}

		function guardar_elemento(){
			if ($this->input->post('id_vehiculo')) {
				 $datos['id_vehiculo'] = $this->input->post('id_vehiculo');
			 }
		  if ($this->input->post('elemento')) {
				$datos['elemento'] = $this->input->post('elemento');
			}
			if ($this->input->post('cantidad')) {
				 $datos['cantidad'] = $this->input->post('cantidad');
				 $datos['disponible'] = $this->input->post('cantidad');
			 }
			 if ($this->input->post('lat')) {
				 $datos['lat'] = $this->input->post('lat');
			 }
			 if ($this->input->post('lon')) {
					$datos['lon'] = $this->input->post('lon');
				}
				if ($this->input->post('id_rol_propietario')) {
 					$datos['id_rol_propietario'] = $this->input->post('id_rol_propietario');
 				}
				$this->Inventario->guardar_elemento($datos);
				redirect(base_url('/inventarios/modificar_inventario/'.$this->input->post('id_rol_propietario')));

		}

		function crear_recorridos(){
			$this->load->view('inventarios/recorridos');
		}

		function mover_elementos(){
			$data['recorridos'] = $this->Inventario->get_recorridos($this->session->userdata('id_rol'));
			$data['elementos']  = $this->Inventario->get_inventario_mov($this->session->userdata('id_rol'));
			$data['inventario'] = $this->Inventario->get_inventario_disp($this->session->userdata('id_rol'));

			$this->load->view('inventarios/mover_elementos',$data);
		}


		function avance_unidades($fecha){
			$this->Inventario->medir_distancia($this->session->userdata('id_juego')) ;
			 $this->Inventario->avance_unidades($this->session->userdata('id_juego'),$fecha);
		}

		function iniciar_recorrido($id,$fecha){
			$data['hora_salida'] = $fecha;
			$data['id_estado'] = 2;
			 $this->Inventario->iniciar_recorrido($data,$id);
		}

		function actualizar_inventario_uso($id,$cantidad,$recorrido){
			$data['cantidad'] = $cantidad;
			$data['id_recorrido'] = $recorrido;
			$this->Inventario->actualizar_inventario_uso($id,$data);
		}

		function max($id){
			$max =	$this->Inventario->get_max($id);
			echo $max->disponible;
		}

		function guardar_movimiento(){
				$datos['id_inventario'] = $this->input->post('id_inventario');
				$datos['cantidad'] = $this->input->post('cantidad');
				$datos['id_recorrido'] = $this->input->post('id_recorrido');
				$datos['id_juego'] = $this->session->userdata('id_juego');
				$this->Inventario->guardar_movimiento($datos);
				$max =	$this->Inventario->get_max($datos['id_inventario']);
				$data['disponible'] = $max->disponible - $datos['cantidad'];
				$this->Inventario->actualizar_disponible($datos['id_inventario'],$data);
				redirect(base_url('/inventarios/mover_elementos'));

		}



		function guardar_elemento_inv(){
						$datos['id_material'] = $this->input->post('id_inventario');
						$datos['cantidad'] = $this->input->post('cantidad');
						$datos['id_inventario_uso'] = $this->input->post('button');
						$this->Inventario->guardar_elemento_inv($datos);
						$max =	$this->Inventario->get_max($datos['id_material']);
						$data['disponible'] = $max->disponible - $datos['cantidad'];

						$this->Inventario->actualizar_disponible($datos['id_material'],$data);
						redirect(base_url('/inventarios/agregar_elementos/'.$this->input->post('button')));

				}

		function cancelar_recorrido($id,$cantidad,$inventario){
			$data['id_estado']= 4;
			$this->Inventario->actualizar_inventario_uso($id,$data);
			$query = $this->Inventario->get_max($inventario);
			$datos['disponible'] = $query-> disponible + $cantidad;
			$this->Inventario->actualizar_disponible($inventario,$datos);
		}


		function cancelar_elemento($id,$cantidad,$inventario){
			$this->Inventario->eliminar_elemento($id);
			$query = $this->Inventario->get_max($inventario);
			$datos['disponible'] = $query-> disponible + $cantidad;
			$this->Inventario->actualizar_disponible($inventario,$datos);
		}

		function eliminar_material($id){
			$data['activo']= 'f';
			$this->Inventario->eliminar_material($id,$data);
		}


		function agregar_elementos($id){
			$data['elementos'] = $this->Inventario->get_elementos_uso($id);
			$data['materiales'] = $this->Inventario->get_materiales_rol($this->session->userdata('id_rol'));
			$data['id_inventario_uso'] = $id;
			$this->load->view('inventarios/agregar_elementos',$data);
		}

		function ver_elementos($id){
			$data = $this->Inventario->get_elementos_uso($id);
			?>
				<table class="table table-striped">
					<tr>
						<th>Elemento</th>
						<th>Cantidad</th>
					</tr>

			<?php
			if ($data) {


			foreach ($data as $elemento) {
				?>
				<tr>


				<td><?= $elemento -> material ?></td>
				<td><?= $elemento -> cantidad ?></td>
			</tr>

				<?php
						}
			}
			?>
		</table><?php
		}
}
