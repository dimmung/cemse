<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ordenes extends CI_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->helper(array('form', 'url'));
		$this->load->model('Orden');
		$this->load->model('Juego');

	}


	public function index()
	{
	 if ($this->session->has_userdata('id_juego')) {

		 $data['ordenes'] = $this->Orden->get_ordenes($this->session->userdata('id_rol'));
		 $data['tipos']   = $this->Orden->get_tipos();
     $this->load->view('ordenes/index',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function index2()
	{
	 if ($this->session->has_userdata('id_juego')) {

		 $data['ordenes'] = $this->Orden->get_compartidas($this->session->userdata('id_rol'));
		 $data['tipos']   = $this->Orden->get_tipos();
		 $this->load->view('ordenes/index2',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}

	public function apreciacion()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 $data['orden'] = null;
     $this->load->view('ordenes/apreciacion',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function plan()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 $data['orden'] = null;
     $this->load->view('ordenes/plan',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function frago()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 $data['orden'] = null;
		 $this->load->view('ordenes/frago',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}

	public function grafica()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 if ($this->session->has_userdata('error')) {


			 $data['error'] = $this->session->userdata('error');


		 } else {

			 $data['error'] = '';

		 }
		 $data['orden'] = null;
		 $this->load->view('ordenes/grafica',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}

	public function organizacion()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 $data['orden'] = null;
		 $this->load->view('ordenes/organizacion',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}

	public function warno()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 $data['orden'] = null;
		 $this->load->view('ordenes/warno',$data);
	 } else {
		 redirect(base_url('/login/index/'));
	 }
	}

	public function decision()
	{
	 if ($this->session->has_userdata('id_juego')) {
		 $data['orden'] = null;
     $this->load->view('ordenes/decision',$data);
	 } else {
	 	 redirect(base_url('/login/index/'));
	 }
	}

	public function guardar(){
		if ($this->input->post('titulo')) {
			 $datos['titulo'] = $this->input->post('titulo');
		 }

		 if ($this->input->post('operacion')) {
				$datos['operacion'] = $this->input->post('operacion');
			}

			if ($this->input->post('datos_ejemplar')) {
				 $datos['datos_ejemplar'] = $this->input->post('datos_ejemplar');
			 }

			if ($this->input->post('firmas')) {
				 $datos['firmas'] = $this->input->post('firmas');
			 }


			if ($this->input->post('referencias')) {
				 $datos['referencias'] = $this->input->post('referencias');
			 }

			 if ($this->input->post('huso')) {
 				 $datos['huso'] = $this->input->post('huso');
 			 }

			 if ($this->input->post('organizacion')) {
					$datos['organizacion'] = $this->input->post('organizacion');
				}

				if ($this->input->post('ejecucion')) {
					$datos['ejecucion'] = $this->input->post('ejecucion');
				}

			 if ($this->input->post('mision')) {
 				 $datos['mision'] = $this->input->post('mision');
 			 }

			 if ($this->input->post('situacion')) {
 				 $datos['situacion'] = $this->input->post('situacion');
 			 }

			 if ($this->input->post('cursos')) {
 				 $datos['cursos'] = $this->input->post('cursos');
 			 }

			 if ($this->input->post('analisis')) {
 				 $datos['analisis'] = $this->input->post('analisis');
 			 }

			 if ($this->input->post('comparacion')) {
 				 $datos['comparacion'] = $this->input->post('comparacion');
 			 }

			 if ($this->input->post('recomendaciones')) {
 				 $datos['recomendaciones'] = $this->input->post('recomendaciones');
 			 }

			 if ($this->input->post('apoyo')) {
					$datos['apoyo'] = $this->input->post('apoyo');
				}

				if ($this->input->post('mando')) {
					$datos['mando'] = $this->input->post('mando');
				}

				if ($this->input->post('clasificacion')) {
					$datos['clasificacion'] = $this->input->post('clasificacion');
				}

				if ($this->input->post('del')) {
					$datos['del'] = $this->input->post('del');
				}

				if ($this->input->post('al')) {
					$datos['al'] = $this->input->post('al');
				}

				if ($this->input->post('previas')) {
					$datos['previas'] = $this->input->post('previas');
				}

 				 $datos['id_rol'] = $this->session->userdata('id_rol');

				 $datos['id_tipo_orden'] = $this->session->userdata('tipo_orden');



			 $this->Orden->guardar($datos);

			  redirect(base_url('/ordenes/index/'));

 	}


	public function guardar_grafica(){
		$config['upload_path']          = './biblioteca/ordenes/';
		$config['allowed_types']        = 'jpg|png';
		$this->load->library('upload', $config);

		if ($this->input->post('titulo')) {
			 $datos['titulo'] = $this->input->post('titulo');
		 }
			if ($this->input->post('firmas')) {
				 $datos['firmas'] = $this->input->post('firmas');
			 }

			if ($this->input->post('referencias')) {
				 $datos['referencias'] = $this->input->post('referencias');
			 }

			 if ($this->input->post('huso')) {
 				 $datos['huso'] = $this->input->post('huso');
 			 }

			 if ($this->input->post('organizacion')) {
					$datos['organizacion'] = $this->input->post('organizacion');
				}

				if ($this->input->post('ejecucion')) {
					$datos['ejecucion'] = $this->input->post('ejecucion');
				}

			 if ($this->input->post('mision')) {
 				 $datos['mision'] = $this->input->post('mision');
 			 }

			 if ($this->input->post('situacion')) {
 				 $datos['situacion'] = $this->input->post('situacion');
 			 }


			 if ($this->input->post('apoyo')) {
					$datos['apoyo'] = $this->input->post('apoyo');
				}

				if ($this->input->post('mando')) {
					$datos['mando'] = $this->input->post('mando');
				}

				$datos['id_rol'] = $this->session->userdata('id_rol');

				$datos['id_tipo_orden'] = $this->session->userdata('tipo_orden');

				if ( ! $this->upload->do_upload('userfile'))
				{


								$error = array('error' => $this->upload->display_errors());
								$this->session->set_userdata('error', $error['error'] );
								$this->session->set_userdata('ver',1);
								redirect(base_url('/ordenes/grafica/'));

				}
				else
				{

								$data = array('upload_data' => $this->upload->data());

								$datos['ruta'] = $data['upload_data']['file_name'];

								$this->Orden->guardar($datos);

								$this->session->set_userdata('error', 'Archivo Cargado con éxito');
								$this->session->set_userdata('ver',1);
								redirect(base_url('/ordenes/index/'));


				}





			 $this->Orden->guardar($datos);

			  redirect(base_url('/ordenes/index/'));

 	}

	public function ver($id){
		if ($this->session->has_userdata('id_juego')) {
		 $receptores = $this->Orden->get_receptores($id);
 		 $data['orden'] = $this->Orden->get_orden($id);

		 if (!$receptores) {
								 if ($this->session->userdata('id_rol') == $data['orden']->id_rol)  {
											 $tipo = $data['orden']-> id_tipo_orden;
											 switch ($tipo) {
												case '1':
													$this->load->view('ordenes/apreciacion_v',$data);
													break;

												case '2':
													$this->load->view('ordenes/plan_v',$data);
													break;

												case '3':
													$this->load->view('ordenes/warno_v',$data);
													break;

												case '4':
													$this->load->view('ordenes/frago_v',$data);
													break;

												case '5':
													$this->load->view('ordenes/grafica_v',$data);
													break;

												case '6':
													$this->load->view('ordenes/organizacion_v',$data);
													break;

												case '7':
													$this->load->view('ordenes/decision_v',$data);
													break;

												default:
													 redirect(base_url('/ordenes/index/',$data));
													break;
											 }

								 } else {

									 redirect(base_url('/ordenes/index/'));

								 }

					} else {
								$i=0;
													foreach ($receptores as $receptor) {
													 if ($receptor->id_rol == $this->session->userdata('id_rol') ) {
														 $i++;
													 }

													if ($i!= 0 ) {

																$tipo = $data['orden']-> id_tipo_orden;
																switch ($tipo) {
																 case '1':
																	 $this->load->view('ordenes/apreciacion_v',$data);
																	 break;

																 case '2':
																	 $this->load->view('ordenes/plan_v',$data);
																	 break;

																 case '3':
																	 $this->load->view('ordenes/warno_v',$data);
																	 break;

																 case '4':
																	 $this->load->view('ordenes/frago_v',$data);
																	 break;

																 case '5':
																	 $this->load->view('ordenes/grafica_v',$data);
																	 break;

																 case '6':
																	 $this->load->view('ordenes/organizacion_v',$data);
																	 break;

																 case '7':
																	 $this->load->view('ordenes/decision_v',$data);
																	 break;

																 default:
																		redirect(base_url('/ordenes/index/',$data));
																	 break;
																}
													}
												}
								}

 	 } else {
 	 	 redirect(base_url('/login/index/'));
 	 }

	}


	public function crear(){
		if ($this->session->has_userdata('id_juego')) {
		 $tipo = $this->input->post('id_tipo_orden');
		 $this->session->set_userdata('tipo_orden',$tipo);
		 switch ($tipo) {
		 	case '1':
		 		$this->load->view('ordenes/apreciacion');
		 		break;

			case '2':
		 		$this->load->view('ordenes/plan');
		 		break;

			case '3':
		 		$this->load->view('ordenes/warno');
		 		break;

			case '4':
		 		$this->load->view('ordenes/frago');
		 		break;

			case '5':
		 		$this->load->view('ordenes/grafica');
		 		break;

			case '6':
				$this->load->view('ordenes/organizacion');
				break;

			case '7':
				$this->load->view('ordenes/decision');
				break;

			default:
				 redirect(base_url('/ordenes/index/'));
				break;
		 }


 	 } else {
 	 	 redirect(base_url('/login/index/'));
 	 }

	}

	function eliminar_orden($id){
		$data['activa']= 'false';
		$this->Orden->eliminar_orden($id,$data);
	}


}
