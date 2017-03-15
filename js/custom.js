function myMap() {
                  var mapCanvas = document.getElementById("map");
                  var myCenter = new google.maps.LatLng(27.680999,85.2957863); 
                  var mapOptions = {center: myCenter, zoom: 10};
                  var map = new google.maps.Map(mapCanvas,mapOptions);
                  var marker = new google.maps.Marker({
                    position: myCenter,
                    animation: google.maps.Animation.BOUNCE
                  });
                  marker.setMap(map);
                  
                  //zoom to 15 when clicking on marker
                  
                  google.maps.event.addListener(marker, 'click', function(){
                    map.setZoom(15);
                    map.setCenter(marker.getposition());
                  });
                }