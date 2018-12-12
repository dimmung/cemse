
    function onMouseDown(evt) {
      if(marker){
        viewer.removeMarker(marker);
        marker = null;
      }
       marker = new giscloud.Marker()
    marker.icon(dummyIcon);
    viewer.addMarker(marker);
    marker.location(evt);
    $('#lat').val(evt.lat);
    $('#lon').val(evt.lon);


}



function cargarmapa(){
  viewer = new giscloud.Viewer("mapViewer", mapId);

  //
  //     // attach some mouse events
      viewer
      .mouseDown(onMouseDown);

      var toolbar = new giscloud.ui.Toolbar({
             viewer: viewer,
             container: "toolbar",
             defaultTools: ["select", "pan", "zoom", "full", "measure"]
          });

}


function cargarmapa1(){
  viewer1 = new giscloud.Viewer("mapViewer1", mapId);
  var lon = localStorage.getItem("lon");
  var lat = localStorage.getItem("lat");

  var coords = new giscloud.LonLat(Number(lon),Number(lat));

  setTimeout(function(){
    viewer1.center(coords);
    viewer1.scale(10);
  },2000);



}


//
giscloud.ready(function() {
giscloud.apiKey(apiKey);
$('#crear_sit').show();
giscloud.layers.reset( mapId,  [layerId] );

});
