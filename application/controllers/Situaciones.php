<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Situaciones extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Juego');

	}


	public function index()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 if ($this->session->has_userdata('error')) {


			 $data['error'] = $this->session->userdata('error');


		 } else {

			 $data['error'] = '';

		 }
		 $data['situaciones'] = $this->Juego->get_situaciones($this->session->userdata('id_juego'));
		 $data['tipos'] = $this->Juego->get_t_situaciones();
		 $data['estados'] = $this->Juego->get_estados();
     $this->load->view('situaciones',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}


	public function do_upload()
		 {
										 $config['upload_path']          = './biblioteca/situaciones';
										 $config['allowed_types']        = 'gif|jpg|png|pdf|mp4|csv';
										 $this->load->library('upload', $config);

										 if ( ! $this->upload->do_upload('userfile'))
										 {


														 $error = array('error' => $this->upload->display_errors());
														 $this->session->set_userdata('error', $error['error'] );
														 $this->session->set_userdata('ver',1);
														 redirect(base_url('/situaciones/index/'));

										 }
										 else
										 {

														 $data = array('upload_data' => $this->upload->data());

														 $datos['nombre'] = $this->input->post('nombre');

														 if ($this->input->post('descripcion')) {
														 		$datos['descripcion'] = $this->input->post('descripcion');
														 	}

														if ($this->input->post('id_tipo_situacion')) {
															 $datos['id_tipo_situacion'] = $this->input->post('id_tipo_situacion');
														 }

														 if ($this->input->post('id_tipo_situacion')) {
																 $datos['id_tipo_situacion'] = $this->input->post('id_tipo_situacion');
															 }

														 if ($this->input->post('id_estado')) {
																 $datos['id_estado'] = $this->input->post('id_estado');
															 }

															 if ($this->input->post('fecha')) {
																	 $datos['fecha'] = $this->input->post('fecha');
																 }

														 $datos['ruta'] = $data['upload_data']['file_name'];

														 $datos['id_juego'] =$this->session->userdata('id_juego');

														 if ($this->input->post('lat')) {
																 $datos['lat'] = $this->input->post('lat');
															 }

														 if ($this->input->post('lon')) {
																 $datos['lon'] = $this->input->post('lon');
															 }

														 $id = $this->Juego->guardar_archivo($datos);


														 $this->session->set_userdata('error', 'Archivo Cargado con éxito');
														 $this->session->set_userdata('ver',1);

														 redirect(base_url('/situaciones/index/'));


										 }



		 }

		 public function ver_situacion($id){
			 $tipos = $this->Juego->get_t_situaciones();
			 $estados = $this->Juego->get_estados();
	 		$data = $this->Juego->get_situacion($id);
			$fecha = str_replace(" ", "T", $data->fecha);
			?>
			<script type="text/javascript">
			localStorage.setItem("lon", <?= $data->lon ?>);
			localStorage.setItem("lat", <?= $data->lat ?>);
			</script>

			<form  id="frm_nueva_situacion1" method="post" enctype="multipart/form-data">
				<div class="form-row">
					<div class="form-group  col-md-3">
						<label for="nombre">Nombre</label>
						<input type="text" class="form-control form-control-sm" id="nombre" name="nombre" placeholder="Nombre" value="<?= $data->nombre ?>" autocomplete="off" required>
					</div>
					<div class="form-group  col-md-4">
						<label for="fecha">Fecha / Hora</label> <br>
						<input type="datetime-local" class="form-control form-control-sm" id="fecha" name="fecha"  value="<?= $fecha ?>" autocomplete="off" >
					 </div>
					 <div class="form-group  col-md-3">
						 <label for="id_tipo_situacion">Tipo de Situacion</label> <br>
								 <select id="id_tipo_situacion" name="id_tipo_situacion" type="text" class="form-control form-control-sm "  >
									 <option value="0" selected >Seleccione  Tipo</option>
									 <?php
									 foreach($tipos as $fila)
									 {
									 ?>
											 <option value="<?= $fila -> id_tipo_situacion ?>" <?php if ($fila -> id_tipo_situacion == $data->id_tipo_situacion){ echo "selected";}?> >
												 <?= $fila -> tipo_situacion ?></option>
									 <?php
									 }
									 ?>
								 </select>
						</div>
						<div class="form-group  col-md-2">
							<label for="id_estado">Estado</label> <br>
									<select id="id_estado" name="id_estado" type="text" class="form-control form-control-sm "  >
										<option value="0" selected >Seleccione  Estado</option>
										<?php
										foreach($estados as $fila)
										{
										?>
												<option value="<?= $fila -> id_estado ?>" <?php if ($fila -> id_estado == $data->id_estado){ echo "selected";}?> >
													<?= $fila -> estado ?></option>
										<?php
										}
										?>
									</select>
						 </div>
				</div>
				<div class="form-row">
					<div class="form-group  col-md-12">
						<label for="descripcion">Descripción</label> <br>
								<textarea id="descripcion" name="descripcion" type="text" class="form-control form-control-sm"  rows="4"><?= $data->descripcion ?></textarea>
					 </div>
				</div>
				<div class="form-row">
					<label for="userfile">Adjunto &nbsp;&nbsp;</label> <a href="<?php echo  base_url("biblioteca/situaciones/".$data->ruta) ?>" target="_blank" style="color:blue;text-decoration:underline;">Ver adjunto</a>

				</div>

				<br><br>

				<div id="mapViewer1">

				</div>
				<br><br>

				<input type="text" class="form-control form-control-sm" id="lat" name="lat"  value="<?= $data->lat ?>" autocomplete="off" hidden style="display:none;">
				<input type="text" class="form-control form-control-sm" id="lon" name="lon"  value="<?= $data->lon ?>" autocomplete="off" hidden style="display:none;">

			</form>





	 	<?php
	 	}



		public function actualizar_situacion($estado,$id){

				$datos['id_estado'] = $estado;
				$datos['id_situacion'] = $id;
				$this->Juego->actualizar_situacion($datos);

		}

		public function eliminar_situacion($id){
				$data['id_estado'] = 5;
			$data['id_situacion'] = $id;
			$this->Juego->actualizar_situacion($data);
		}





}
