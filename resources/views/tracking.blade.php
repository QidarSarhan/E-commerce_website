{{-- <!DOCTYPE html> --}}
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />

    <style type="text/css">
        #map {
            height: 610px;
        }
    </style>
</head>

<body>

    <div id="map"></div>

    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        function addToMap(locations, center) {
            var map = L.map('map', {
                center: center,
                zoom: 12,
            });




            // var map = L.map('map').setView([51.505, -0.09], 13);

            // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png?{foo}', {
            //     maxZoom: 19,
            //     attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
            // }).addTo(map);

            // L.marker([51.5, -0.09]).addTo(map)
            //     .bindPopup('A pretty CSS popup.<br> Easily customizable.')
            //     .openPopup();


            var customTitle = "";

            for (var i = 0; i < locations.length; i++) {
                customTitle = i.toString();
                if (i == (locations.length - 1)) {
                    customTitle = "هنا";
                }
                marker = new L.marker([locations[i][0], locations[i][1]])
                    .addTo(map)
                    .bindPopup(customTitle)
                    .openPopup();
            }
        }

        var arr = [];
        $.ajax({

            url: '{{ route('tracking') }}',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                addToMap(data, data.slice(-1)[0]);
            },
            error: function(request, error) {
                alert("Request: " + JSON.stringify(request));
            }
        });
    </script>
</body>

</html>
