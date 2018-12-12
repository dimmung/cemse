$(document).ready(function(){

	$('#import_csv_proyecto').on('submit', function(event){
		event.preventDefault();
		$.ajax({
			url:baseUrl+'csv_imports/import_proyecto',
			method:"POST",
			data:new FormData(this),
			contentType:false,
      cache:false,
      processData:false,
			beforeSend:function(){
				$('#import_csv_btn_proyecto').html('Cargando...');
			},
			success:function(data)
			{
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
				$('#import_csv_proyecto')[0].reset();
				$('#import_csv_btn_proyecto').attr('disabled', false);
				$('#import_csv_btn_proyecto').html('Importar CSV');
			}, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_proyecto')[0].reset();
				$('#import_csv_btn_proyecto').attr('disabled', false);
				$('#import_csv_btn_proyecto').html('Importar CSV');
			}
		});
	});

  $('#import_csv_obra').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import_obra',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_obra').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_obra')[0].reset();
        $('#import_csv_btn_obra').attr('disabled', false);
        $('#import_csv_btn_obra').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_obra')[0].reset();
				$('#import_csv_btn_obra').attr('disabled', false);
				$('#import_csv_btn_obra').html('Importar CSV');
			}
    })
  });


  $('#import_csv_avff').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_avff').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_avff')[0].reset();
        $('#import_csv_btn_avff').attr('disabled', false);
        $('#import_csv_btn_avff').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_avff')[0].reset();
				$('#import_csv_btn_avff').attr('disabled', false);
				$('#import_csv_btn_avff').html('Importar CSV');
			}
    })
  });

  $('#import_csv_sol').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import_sol',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_sol').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_sol')[0].reset();
        $('#import_csv_btn_sol').attr('disabled', false);
        $('#import_csv_btn_sol').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_sol')[0].reset();
				$('#import_csv_btn_sol').attr('disabled', false);
				$('#import_csv_btn_sol').html('Importar CSV');
			}
    })
  });

  $('#import_csv_geom_pro').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import_geom_pro',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_geom_pro').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_geom_pro')[0].reset();
        $('#import_csv_btn_geom_pro').attr('disabled', false);
        $('#import_csv_btn_geom_pro').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_geom')[0].reset();
				$('#import_csv_btn_geom_pro').attr('disabled', false);
				$('#import_csv_btn_geom_pro').html('Importar CSV');
			}
    })
  });

  $('#import_csv_geom_obra').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import_geom_obra',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_geom_obra').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_geom_obra')[0].reset();
        $('#import_csv_btn_geom_obra').attr('disabled', false);
        $('#import_csv_btn_geom_obra').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_geom_obra')[0].reset();
				$('#import_csv_btn_geom_obra').attr('disabled', false);
				$('#import_csv_btn_geom_obra').html('Importar CSV');
			}
    })
  });

  $('#import_csv_geom_sol').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import_geom_sol',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_geom_sol').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_geom_sol')[0].reset();
        $('#import_csv_btn_geom_sol').attr('disabled', false);
        $('#import_csv_btn_geom_sol').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_geom_sol')[0].reset();
				$('#import_csv_btn_geom_sol').attr('disabled', false);
				$('#import_csv_btn_geom_sol').html('Importar CSV');
			}
    })
  });

  $('#import_csv_geom_colec').on('submit', function(event){
    event.preventDefault();
    $.ajax({
      url:baseUrl+'csv_imports/import_geom_colec',
      method:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      beforeSend:function(){
        $('#import_csv_btn_geom_colec').html('Cargando...');
      },
      success:function(data)
      {
				Swal(
					'¡Éxito!',
					'Datos Guardados con Éxito',
					'success'
				)
        $('#import_csv_geom_colec')[0].reset();
        $('#import_csv_btn_geom_colec').attr('disabled', false);
        $('#import_csv_btn_geom_colec').html('Importar CSV');
      }, error: function(error){
				Swal(
					'Error',
					'Hubo un fallo al guardar',
					'error'
				)
				$('#import_csv_geom_colec')[0].reset();
				$('#import_csv_btn_geom_colec').attr('disabled', false);
				$('#import_csv_btn_geom_colec').html('Importar CSV');
			}
    })
  });

});
