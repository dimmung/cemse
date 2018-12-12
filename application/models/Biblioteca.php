<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Biblioteca extends CI_Model {

    public function __construct() {
      $this->load->database();
    }

   function guardar_archivo($data) {
          $this->db->insert('juego.biblioteca', $data);
        }

    function get_archivos($id){
    $this->db->where('id_juego', $id);
    $this->db->order_by('id_juego', 'DESC');
    $data = $this->db->get('juego.biblioteca');
    return $data->result();
    }

    function eliminar($id){
      $this->db->where('id_archivo', $id);
      $this->db->delete('juego.biblioteca');
    }
}
