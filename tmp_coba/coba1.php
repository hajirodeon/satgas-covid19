<?php
$keyku = "AIzaSyBZ73oHLqNFmGX6bs3qyyRAoCim-_WxdqQ";
?>




<html>
<style type="text/css">
    #map_canvas {
        height: 760px;
        width: 1100px;
        position: static;
        top: 100px;
        left: 200px;
    }
</style>

<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&key=<?php echo $keyku;?>">
</script>

<script type="text/javascript">
    var marker;

    function initialize() {
        var latlng = new google.maps.LatLng(42.55308, 9.140625);

        var myOptions = {
            zoom: 2,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            streetViewControl: false,
            mapTypeControl: false,
        };

        var map = new google.maps.Map(document.getElementById("map_canvas"),
                myOptions);


        google.maps.event.addListener(map, 'click', function(event) {
            placeMarker(event.latLng);
        });

        function placeMarker(location) {



            if (marker == undefined){
                marker = new google.maps.Marker({
                    position: location,
                    map: map, 
                    animation: google.maps.Animation.DROP,
                });
            }
            else{
                marker.setPosition(location);
            }
            //map.setCenter(location);

        }


    }

</script>
</head>


<body onload="initialize()">
<div id="map_canvas" style="1500px; 1000px"></div>
</body>
</html>