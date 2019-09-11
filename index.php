<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <script src="https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js"></script>
  <link href="https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css" rel="stylesheet" />
  <title>
    Welcome at Penny Lane</title>
</head>

<body>

  <?php
  require_once(__DIR__ . '/components/nav.php');
  ?>

  <div id="map_properties">
    <div id="map"></div>
    <div id="properties"></div>
  </div>
  <script src="js/app.js"></script>
</body>

</html>