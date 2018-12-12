<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Orden extends CI_Model {

    public function __construct() {
      $this->load->database();
    }

     function get_tipos() {
      $query = $this->db->get('ordenes.tipo_orden');
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }
    }


    function get_ordenes($id) {
      $this->db->where('orden.id_rol', $id);
      $this->db->where('orden.activa', 't');
      $this->db->join('ordenes.tipo_orden','tipo_orden.id_tipo_orden = orden.id_tipo_orden','left');
      $this->db->order_by('orden.id_orden', 'desc');
     $query = $this->db->get('ordenes.orden');
     if ($query->num_rows() > 0) {
         return $query->result();
     } else {
       return null;
     }
   }

   function get_compartidas($id) {
     $this->db->where('compartidas.id_rol', $id);
     $this->db->where('orden.activa', 't');
     $this->db->join('ordenes.orden','orden.id_orden = compartidas.id_orden','left');
     $this->db->join('ordenes.tipo_orden','tipo_orden.id_tipo_orden = orden.id_tipo_orden','left');
     $this->db->join('juego.roles_x_juego','roles_x_juego.id_rol = orden.id_rol','left');
     $this->db->order_by('orden.id_orden', 'desc');
    $query = $this->db->get('ordenes.compartidas');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
      return null;
    }
  }

    function guardar($data){
      $this->db->insert('ordenes.orden', $data);
    }

    function get_orden($id){
      $this->db->where('orden.id_orden', $id);
     $query = $this->db->get('ordenes.orden');
     if ($query->num_rows() > 0) {
         return $query->row();
     } else {
       return null;
     }
    }


    function eliminar_orden($id,$data) {
    $this->db->where('id_orden',$id);
    $this->db->update('ordenes.orden',$data);

   }


   function get_receptores($id){
     $this->db->where('id_orden', $id);
     $query = $this->db->get('ordenes.compartidas');
     if ($query->num_rows() > 0) {
         return $query->result();
     } else {
       return null;
     }
   }


}
