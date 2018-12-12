$('#juegos').DataTable({
  "order": [],
  "language": {
          "url": baseUrl+"assets/DataTables/spanish.json"
      }
  } );

  $('#usuarios_juego').DataTable({
    "order": [],
    "language": {
            "url": baseUrl+"assets/DataTables/spanish.json"
        }
    } );

    $('#roles').DataTable({
      "order": [],
      "language": {
              "url": baseUrl+"assets/DataTables/spanish.json"
          }
      } );

      $('#situaciones').DataTable({
        "order": [],
        "language": {
                "url": baseUrl+"assets/DataTables/spanish.json"
            }
        } );



  $('#crear_juego').click(function() {
    Swal({
      text: '¿Desea guardar los Datos?',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseUrl+"juegos/crear",
          method:"POST",
          data: $("#frm_nuevo_juego").serialize(),
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
              'El hubo un fallo al guardar los datos',
              'error'
            )
          }
        })
      }
    })

  });

  $('#crear_material').click(function() {
    Swal({
      text: '¿Desea guardar los Datos?',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $("#frm_nuevo_material").submit();
      }
    })

  });

  $('#crear_situacion').click(function() {
    Swal({
      text: '¿Desea guardar los Datos?',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $("#frm_nueva_situacion").submit();
      }
    })

  });

  function agregar_usuario(id) {
    Swal({
      text: '¿Desea añadir el usuario al juego?',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseUrl+"juegos/agregar/"+id,
          success: function(result) {

            Swal(
              '¡Éxito!',
              'Usuario Agregado con Éxito',
              'success'
            )
            setTimeout(function(){
              location.reload()},2000);

          }, error: function(error){
            Swal(
              'Error',
              'El hubo un fallo al agregar al usuario, verifique si el usuario ya existe en el juego',
              'error'
            )
          }
        })
      }
    })

  };

  function eliminar_material(id) {
    Swal({
      text: '¿Desea remover el material del juego?',
      type: 'info',
      showCancelButton: true,
      confirmButtonText: 'Si',
      cancelButtonText: 'No'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: baseUrl+"inventarios/eliminar_material/"+id,
          success: function(result) {

            Swal(
              '¡Éxito!',
              'Elemento Removido con Éxito',
              'success'
            )
            setTimeout(function(){
              location.reload()},2000);

          }, error: function(error){
            Swal(
              'Error',
              'Hubo un error al remover el elemento',
              'error'
            )
          }
        })
      }
    })

  };


    function eliminar_usuario(id) {
      Swal({
        text: '¿Desea remover el usuario del juego?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseUrl+"juegos/eliminar/"+id,
            success: function(result) {

              Swal(
                '¡Éxito!',
                'Usuario Removido con Éxito',
                'success'
              )
              setTimeout(function(){
                location.reload()},2000);

            }, error: function(error){
              Swal(
                'Error',
                'Hubo un error al remover el usuario',
                'error'
              )
            }
          })
        }
      })

    };

    function eliminar_juego(id) {
      Swal({
        text: '¿Desea remover el juego?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseUrl+"juegos/eliminar_juego/"+id,
            success: function(result) {

              Swal(
                '¡Éxito!',
                'Juego Removido con Éxito',
                'success'
              )
              setTimeout(function(){
                location.reload()},2000);

            }, error: function(error){
              Swal(
                'Error',
                'Hubo un error al remover el juego',
                'error'
              )
            }
          })
        }
      })

    };

    function eliminar_situacion(id) {
      Swal({
        text: '¿Desea remover la Situacion?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseUrl+"situaciones/eliminar_situacion/"+id,
            success: function(result) {

              Swal(
                '¡Éxito!',
                'Situación Removida con Éxito',
                'success'
              )
              setTimeout(function(){
                location.reload()},2000);

            }, error: function(error){
              Swal(
                'Error',
                'Hubo un error al remover la Situación',
                'error'
              )
            }
          })
        }
      })

    };


    function ver_rol(id) {
          $.ajax({
            url: baseUrl+"usuarios/ver_rol/"+id,
            success: function(result) {
              $('#cuerpo_modal').html(result);
              $('#modal_rol').click();
        }
      })
    };

    function ver_situacion(id) {
          $.ajax({
            url: baseUrl+"situaciones/ver_situacion/"+id,
            success: function(result) {
              $('#situacion1').html(result);
              $('#ver_sit').click();
        }
      })
    };


    $('#crear_rol').click(function() {
      Swal({
        text: '¿Desea guardar los Datos?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseUrl+"usuarios/crear_rol",
            method:"POST",
            data: $("#frm_nuevo_rol").serialize(),
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
                'El hubo un fallo al guardar los datos',
                'error'
              )
            }
          })
        }
      })

    });


    function eliminar_rol(id) {
      Swal({
        text: '¿Desea remover el rol del juego?',
        type: 'info',
        showCancelButton: true,
        confirmButtonText: 'Si',
        cancelButtonText: 'No'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: baseUrl+"usuarios/eliminar_rol/"+id,
            success: function(result) {

              Swal(
                '¡Éxito!',
                'Rol Removido con Éxito',
                'success'
              )
              setTimeout(function(){
                location.reload()},2000);

            }, error: function(error){
              Swal(
                'Error',
                'Hubo un error al remover el rol',
                'error'
              )
            }
          })
        }
      })

    };

    function editar_vehiculo(id) {


          window.location.replace( baseUrl+"inventarios/editar_vehiculo/"+id);

    };


    function buscar_inventario(){
      var rol = $('#id_rol').val();
      $('#id_rol_propietario').val($('#id_rol').val());
      $.ajax({
        url: baseUrl+"inventarios/buscar_inventario/"+rol,
        success: function(result) {
          $('#tablas').html(result);

          }

      })
    }


    function actualizar_juego(id){
      var estado = $('#id_estado'+id).val();

      $.ajax({
        url: baseUrl+"juegos/actualizar_juego/"+estado+"/"+id,
        success: function(result) {
          if (result == 1) {
            Swal(
              '¡Éxito!',
              'Estado Actualizado con Éxito',
              'success'
            )
            setTimeout(function(){
              location.reload()},2000);
          } else {
            Swal(
              'Error',
              'Hubo un error ya existe un juego iniciado',
              'error'
            )
          }



          }, error: function(error){
            Swal(
              'Error',
              'Hubo un error al actualizar el Estado',
              'error'
            )
          }

      })
    }


    function actualizar_situacion(id){
      var estado = $('#id_estado_'+id).val();
      $.ajax({
        url: baseUrl+"situaciones/actualizar_situacion/"+estado+"/"+id,
        success: function(result) {
            Swal(
              '¡Éxito!',
              'Estado Actualizado con Éxito',
              'success'
            )
            setTimeout(function(){
              location.reload()},2000);

          }, error: function(error){
            Swal(
              'Error',
              'Hubo un error al actualizar el Estado',
              'error'
            )
          }

      })
    }
