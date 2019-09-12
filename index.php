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
    <div id="properties">

      <?php
      $sjProperties = file_get_contents(__DIR__ . '/data/properties.json');
      $jProperties = json_decode($sjProperties);
      $strBluePrint = '<div class="property" id="V-{{id}}">
    <div>PRICE {{price}} dkk</div>
    <img src="img\{{path}}">
    <div>ADDRESS {{address}}</div>
        <div>ZIP {{zip}}</div>
    
  </div>';
      foreach ($jProperties as $jProperty) {
        $sCopyBluePrint = $strBluePrint;
        $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{path}}', $jProperty->img, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{id}}', $jProperty->id, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{address}}', $jProperty->address, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{zip}}', $jProperty->zip, $sCopyBluePrint);
        echo $sCopyBluePrint;
      }
      ?>

    </div>
  </div>
  <script src="js/app.js"></script>
</body>

</html>