
$('#dibujar').click(function() {
    geomType = 'line';
    $('#nombre_r').show();
    $('#comenzar').show();

});

$('#comenzar').click(function() {
    startDrawing();

});

function onDrawEnd(graphic) {
    var data = featureData(),
        feature = new giscloud.Feature(data);
    feature.geometry = graphic.geometry().toOGC();
    clearFeatureData();
    $('#nombre_r').hide();
    $('#comenzar').hide();
    feature.update().done(onUpdate());
}

function onDrawCancel() {
  clearFeatureData();
  $('#nombre_r').hide();
  $('#comenzar').hide();
}


function clearFeatureData() {
    $("#nombre_r").val("");
}


function featureData() {
    return {
        data: {
            nombre_recorrido: $("#nombre_r").val(),
            id_juego: juegoId,
            id_rol:rolId
        },
        __layerId: recorridos
    };
}

function onUpdate() {
    giscloud.layers.reset(mapId, [layerId])
    .done(function () {
        viewer.graphic.clear();
        viewer.reloadMap();
    });
}


function startDrawing() {
    viewer.graphic.draw(geomType).then(onDrawEnd, onDrawCancel);
}


function actualizar(){
  viewer.reloadMap();
  console.log('actualizado');
}

function cargarmapa(){
  viewer = new giscloud.Viewer("mapViewer", mapId);
  viewer.loading.done(function () {
      viewer.select(true);
  });
  viewer.featureClick((feature) => {
      $('#load').show();
      getFeature(feature)
          .then(data => {
              data = { feature: data };
              obj = data.feature.data;
              var dat = '';
              for (const prop in obj) {
                  dat+='<br>';
                  dat += '<table>';
                  dat += '<tr >';
                  dat += '<td>&nbsp;&nbsp;</td>';
                  dat += '<th style="font-size:14px;">';
                  var titulo = `${prop}`;
                  titulo = Mays(titulo.toLowerCase());
                  titulo = titulo.replace("_", " ");
                  dat += titulo+' : ';
                  dat += '</th><td></td>';
                  dat += '<td style="font-size:12px;">';
                  dat += ` ${obj[prop]}`;
                  dat += '</td>';
                  dat += '</tr>';
                  dat += '</table>';
                  // console.log(`${prop} : ${obj[prop]}`);
                }
                $('#busqueda').html(dat);
                $('#barra').show();
                $('#load').hide();
          })
          .catch(error => {
              console.log(error);
          });
      });
}

$('#boton_cerrar').click(function() {
  $('#barra').hide();
});

function getFeature(feature) {
    return giscloud.features.byId(feature.layerId, feature.featureId, { geometry: 'geojson' });
}
giscloud.ready(function() {
giscloud.apiKey(apiKey);
giscloud.layers.reset( mapId,  [layerId] );
cargarmapa();

 setTimeout(function(){
setInterval(function(){ actualizar(); }, 10000);
},20000);
});

function Mays(string){
  return string.charAt(0).toUpperCase() + string.slice(1);
}
