
var geocoder = new google.maps.Geocoder();
function geocodePosition(pos) {
  geocoder.geocode({
    latLng: pos
  }, function(responses) {
    if (responses && responses.length > 0) {
      updateMarkerAddress(responses[0].formatted_address);
    } else {
      updateMarkerAddress('Cannot determine address at this location.');
    }
  });
}

function updateMarkerStatus(str) {
  document.getElementById('markerStatus').innerHTML = str;
}
function grabLonLat(latLng) {


}


function updateMarkerPosition(latLng) {
    var lat = latLng.lat();
    var lng = latLng.lng();
    //display lat and long in info container for viewing
  document.getElementById('info').innerHTML = [
    latLng.lat(),
    latLng.lng()
  ].join(', ');

    //dynamically add lat and long to containers to pass data to DB
    $("input[name='lat']").val(lat);
    $("input[name='long']").val(lng);

}


function updateMarkerAddress(str) {
  document.getElementById('address').innerHTML = str;
}
function initialize() {
  var latLng = new google.maps.LatLng(-33.9242800096056, 18.418047851562505);
  var map = new google.maps.Map(document.getElementById('mapCanvas'), {
    zoom: 8,
    center: latLng,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var marker = new google.maps.Marker({
    position: latLng,
    title: 'Point A',
    map: map,
    draggable: true
  });


  // Update current position info.
  updateMarkerPosition(latLng);
    grabLonLat(latLng);
  geocodePosition(latLng);

  // Add dragging event listeners.
  google.maps.event.addListener(marker, 'dragstart', function() {
    updateMarkerAddress('Dragging...');
  });

  google.maps.event.addListener(marker, 'drag', function() {
    updateMarkerStatus('Dragging...');
    updateMarkerPosition(marker.getPosition());
  });

  google.maps.event.addListener(marker, 'dragend', function() {
    updateMarkerStatus('Drag ended');
    geocodePosition(marker.getPosition());
  });
}

// Onload handler to fire off the app.

google.maps.event.addDomListener(window, 'load', initialize);
$(document).ready(function(){
$('.day').click(function(){
    var val = $(this).data('days');
    doAjax(val);
});

//Display or hide amount of days
function doAjax(val){
    if(val === 7){
        $("#7").hide();
        $("#8").hide();
        $("#9").hide();
    } else {
        $("#7").show();
        $("#8").show();
        $("#9").show();
    }

}
});


