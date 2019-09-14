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
    
    <img src="img\{{path}}">
    <div>PRICE {{price}} dkk</div>
    <div>ADDRESS {{address}}</div>
        <div>ZIP {{zip}}</div>
        <div>Agent {{agentName}}</div>
        
        <svg class="heart" viewBox="0 0 32 29.6" id="{{id}}">
        <path d="M23.6,0c-3.4,0-6.3,2.7-7.6,5.6C14.7,2.7,11.8,0,8.4,0C3.8,0,0,3.8,0,8.4c0,9.4,9.5,11.9,16,21.2
        c6.1-9.3,16-12.1,16-21.2C32,3.8,28.2,0,23.6,0z"/>
      </svg> 
    <a href="property.php?id={{id}}">Details</a>
  </div>';
      foreach ($jProperties as $jProperty) {
        $sCopyBluePrint = $strBluePrint;
        $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{path}}', $jProperty->img[0], $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{id}}', $jProperty->id, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{address}}', $jProperty->address, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{zip}}', $jProperty->zip, $sCopyBluePrint);
        $sCopyBluePrint = str_replace('{{agentName}}', $jProperty->agentName, $sCopyBluePrint);
        echo $sCopyBluePrint;
      }
      ?>

    </div>
  </div>
  <script src="js/app.js"></script>
  <script src="js/property.js"></script>
</body>

</html>