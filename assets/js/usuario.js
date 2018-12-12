function buscar_roles(rol = null) {
  var id = $("#departamento").val();
  if(rol) {
    var url = baseUrl+"/usuarios/get_roles/"+id+"/"+rol;
  } else {
    var url = baseUrl+"/usuarios/get_roles/"+id;
  }
  $.ajax({
    url: url,
    success: function(result) {
      $("#rol").html(result);
      $("#rol").removeClass('oculto');
      $("#label_rol").removeClass('oculto');
    }
  });
}

function carga_inicial() {
  buscar_roles(rol);
}

function restablecer_clave(id) {
  Swal({
    text: '¿Desea restablecer la contraseña a éste usuario?',
    type: 'info',
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: baseUrl+"/usuarios/restablecer_clave/"+id,
        success: function(result) {
          Swal(
            '¡Éxito!',
            'Constraseña restaurada con éxito',
            'success'
          )
        }, error: function(error){
          Swal(
            'Error',
            'Hubo un fallo restableciendo la clave',
            'error'
          )
        }
      });
    }
  })
}

function actualizar_rol(id) {
  var permisos = $('input[type="checkbox"][name="check_'+id+'[]"]:checked').map(function() { return this.value; }).get();
  Swal({
    text: '¿Desea reasignar los permisos a éste rol?',
    type: 'question',
    showCancelButton: true,
    confirmButtonText: 'Si',
    cancelButtonText: 'No'
  }).then((result) => {
    if (result.value) {
      $.ajax({
        url: baseUrl+"/usuarios/actualizar_permisos/",
        type: "post",
        data: {
                permisos: permisos,
                id: id
              },
        success: function(result) {
          Swal(
            '¡Éxito!',
            'Permisos asignados con éxito',
            'success'
          )
        }, error: function(error) {
          Swal(
            'Error',
            'Hubo un fallo actualizando los permisos',
            'error'
          )
        }
      });
    }
  })
}



$('#usuarios').DataTable({
  "order": [],
  "language": {
          "url": baseUrl+"assets/DataTables/spanish.json"
      }
  } );

  $('#crear').click(function() {
    var clave = $('#clave').val();
    var clave1 = $('#clave1').val();
    if (clave == clave1) {
      validar();
    } else {
      Swal(
        'Error',
        'Las Contraseñas no coinciden',
        'error'
      )
    }

  });

  function validar() {

    Swal({
      text: '¿Desea guardar los Datos?',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseUrl+"usuarios/crear",
          method:"POST",
          data: $("#frm_nuevo_usuario").serialize(),
          success: function(result) {

            Swal(
              '¡Éxito!',
              'Datos Guardados con Éxito',
              'success'
            )
            setTimeout(function(){
              location.reload()},2000);

          }, error: function(error){
            Swal(
              'Error',
              'El RUT o Usuario ya existe',
              'error'
            )
          }
        })
      }
    })

  };
