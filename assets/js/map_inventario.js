

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
giscloud.layers.reset( mapId,  [layerId] );
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


//
giscloud.ready(function() {
  giscloud.apiKey(apiKey);
giscloud.layers.reset( mapId,  [layerId] );


});
