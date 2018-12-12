<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inventario extends CI_Model {

    public function __construct() {
      $this->load->database();
    }

     function get_tipos_v(){
       $query = $this->db->get('juego.tipo_elemento');
       if ($query->num_rows() > 0) {
           return $query->result();
       } else {
         return null;
       }

     }

     function get_unidades(){
       $query = $this->db->get('juego.unidades');
       if ($query->num_rows() > 0) {
           return $query->result();
       } else {
         return null;
       }

     }

     function get_iconos(){
       $query = $this->db->get('juego.iconos');
       if ($query->num_rows() > 0) {
           return $query->result();
       } else {
         return null;
       }

     }

     function guardar_vehiculo($data) {
     $this->db->insert('juego.vehiculos',$data);

    }


    function guardar_materiales($data) {
    $this->db->insert('juego.materiales',$data);

   }

    function actualizar_vehiculo($data,$id) {
    $this->db->where('id_vehiculo',$id);
    $this->db->update('juego.vehiculos',$data);

   }


   function eliminar_material($id,$data) {
   $this->db->where('id_material',$id);
   $this->db->update('juego.materiales',$data);

  }

  function eliminar_elemento($id) {
  $this->db->where('id_unidad',$id);
  $this->db->delete('juego.unidades_inventario');

 }

    function get_vehiculos(){
      $this->db->select('*,vehiculos.descripcion as descrip');
      $this->db->join('juego.unidades', 'vehiculos.id_unidad = unidades.id_unidad','left');
      $this->db->join('juego.tipo_elemento', 'vehiculos.id_tipo_elemento = tipo_elemento.id_tipo_elemento','left');
      $query = $this->db->get('juego.vehiculos');
      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }

    }


    function get_vehiculo($id){
      $this->db->where('id_vehiculo',$id);
      $query = $this->db->get('juego.vehiculos');
      if ($query->num_rows() > 0) {
          return $query->row();
      } else {
        return null;
      }

    }

    function get_inventario($id){
      $this->db->where('id_rol_propietario',$id);
      $this->db->join('juego.vehiculos', 'vehiculos.id_vehiculo = inventario.id_vehiculo','left');
      $this->db->join('juego.materiales', 'materiales.id_material = inventario.elemento','left');
      $query = $this->db->get('juego.inventario');

      if ($query->num_rows() > 0) {
          return $query->result();
      } else {
        return null;
      }

    }

    function guardar_elemento($data){
      $this->db->insert('juego.inventario', $data);
      $id =  $this->db->insert_id();
      $query = "SELECT  st_setsrid(st_makepoint(".$data['lon'].",".$data['lat']. "), 3857) AS geom;";
     $geom = $this->db->query($query);
     $geom1 = $geom->row();
     $datos['geom'] = $geom1->geom;
     $this->db->where('id_inventario',$id);
     $this->db->update('juego.inventario', $datos);
    }




    function get_recorridos($id){
      $this->db->where('id_rol',$id);
      $query = $this->db->get('juego.lineas');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
          return null;
        }
    }

    function get_inventario_mov($id){
      $this->db->where('inventario.id_rol_propietario',$id);
      $this->db->select('*,inventario_x_uso.cantidad as cantidad1');
      $this->db->join('juego.inventario', 'inventario.id_inventario = inventario_x_uso.id_inventario','left');
      $this->db->join('juego.vehiculos', 'vehiculos.id_vehiculo = inventario.id_vehiculo','left');
      $this->db->join('juego.lineas', 'inventario_x_uso.id_recorrido = lineas.id_recorrido','left');
      $this->db->join('juego.estado', 'inventario_x_uso.id_estado = estado.id_estado','left');
      $this->db->order_by('inventario_x_uso.id_recorrido');
      $query = $this->db->get('juego.inventario_x_uso');
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
          return null;
        }
    }


    function medir_distancia($id){
      $this->db->select('lineas.id_recorrido AS id,
                          lineas.geom,
                          st_length(lineas.geom) AS distancia')
                      ->from('juego.lineas')
                      ->where('id_juego',$id);
      $sql=$this->db->get();
      $datos = $sql->result();
      foreach ($datos as $dato) {
        $dist = array ("distancia" => $dato->distancia);
        $this->db->where('id_recorrido',$dato->id)
                 ->update('juego.lineas',$dist);
      }
    }

    function avance_unidades($id,$fecha){
      $this->db->where('inventario.id_vehiculo is not null');
      $this->db->where('inventario_x_uso.id_estado = 2');
      $this->db->where('lineas.id_juego',$id);
      $this->db->select('inventario_x_uso.id_recorrido,vehiculos.velocidad,inventario_x_uso.hora_salida, lineas.distancia ,inventario_x_uso.hora_llegada ');
      $this->db->join('juego.lineas','inventario_x_uso.id_recorrido = lineas.id_recorrido');
      $this->db->join('juego.inventario','inventario_x_uso.id_inventario = inventario.id_inventario');
      $this->db->join('juego.vehiculos','inventario.id_vehiculo = vehiculos.id_vehiculo');
      $sql=$this->db->get('juego.inventario_x_uso');
      $datos = $sql->result();
      foreach ($datos as $dato) {
        $distancia = ($dato->distancia / 1000);
        $fecha2 = new DateTime($dato ->hora_salida,new DateTimeZone('America/Santiago'));
        $fecha1 = new DateTime($fecha,new DateTimeZone('America/Santiago'));
        $intervalo = $fecha2->diff($fecha1);
        $horas = ($intervalo->d *24)+$intervalo->h+($intervalo->i/60);
        $distancia2 = ($dato->velocidad * $horas);
        $total = $distancia2 / $distancia;
        if ($total < 1) {
          $query = ('st_line_interpolate_point(lineas.geom,'.$total.'::double precision) AS punto');
        } else {

          $query = ('st_line_interpolate_point(lineas.geom,1::double precision) AS punto');
          $data['id_estado'] = 3;
        }
          $this->db->select($query)
                   ->from('juego.lineas')
                   ->where('id_recorrido', $dato->id_recorrido);
          $geom = $this->db->get();
          $geom1= $geom->row();
          if ($dato -> hora_llegada == null && $total >= 1) {
              $data['hora_llegada'] = $fecha;
          }

          $data['geom'] = $geom1->punto;
          $this->db->where('id_recorrido', $dato->id_recorrido);
          $this->db->update('juego.inventario_x_uso', $data);
          echo $geom1->punto;


      }

    }

    function get_hora($id) {
     $this->db->where('id_juego',$id);
       $this->db->select('h_tactica');
     $query = $this->db->get('juego.juego');
         return $query->row();
    }

    function iniciar_recorrido($data,$id) {
    $this->db->where('id_recorrido',$id);
    $this->db->update('juego.inventario_x_uso',$data);

   }

   function actualizar_inventario_uso($id,$data){
     $this->db->where('id_inventario_uso',$id);
     $this->db->update('juego.inventario_x_uso',$data);
   }

   function get_inventario_disp($id){
     $this->db->where('id_rol_propietario',$id);
     $this->db->where('disponible > 0');
     $this->db->join('juego.vehiculos', 'vehiculos.id_vehiculo = inventario.id_vehiculo','inner');
     $query= $this->db->get('juego.inventario');
     if ($query->num_rows() > 0) {
         return $query->result();
     } else {
       return null;
     }
   }

   function get_max($id){
     $this->db->where('id_inventario',$id);
     $query= $this->db->get('juego.inventario');
     return $query->row();

   }

   function guardar_movimiento($data) {
   $this->db->insert('juego.inventario_x_uso',$data);

  }


  function guardar_elemento_inv($data) {
  $this->db->insert('juego.unidades_inventario',$data);

 }

  function actualizar_disponible($id,$data){
    $this->db->where('id_inventario',$id);
    $this->db->update('juego.inventario',$data);
  }

  function get_materiales(){
      $this->db->where("activo = 't'" );
    $query= $this->db->get('juego.materiales');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
      return null;
    }
  }

  function get_elementos_uso($id){
    $this->db->where("id_inventario_uso",$id );
    $this->db->select("materiales.material, inventario.disponible, unidades_inventario.cantidad, unidades_inventario.id_material, unidades_inventario.id_unidad  ");
    $this->db->join('juego.inventario', 'inventario.id_inventario = unidades_inventario.id_material','inner');
    $this->db->join('juego.materiales', 'materiales.id_material = inventario.elemento','inner');
    $query= $this->db->get('juego.unidades_inventario');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
      return null;
    }
  }


  function get_materiales_rol($id){
    $this->db->where("inventario.id_rol_propietario",$id);
    $this->db->where("inventario.disponible > 0");
    $this->db->select("inventario.id_inventario, materiales.material, inventario.disponible, inventario.elemento ");
    $this->db->join('juego.materiales', 'materiales.id_material = inventario.elemento','inner');
    $query= $this->db->get('juego.inventario');
    if ($query->num_rows() > 0) {
        return $query->result();
    } else {
      return null;
    }
  }
}
