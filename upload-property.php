<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Upload property</title>
</head>

<body>

  <?php

  session_start();
  $agent = $_SESSION['user'];

  // echo print_r($_FILES);

  $extension = pathinfo($_FILES['imageProperty']['name'])['extension'];
  $sUniqueImageName = uniqid() . '.' . $extension;


  move_uploaded_file($_FILES['imageProperty']['tmp_name'], __DIR__ . "/img/$sUniqueImageName");

  $strPrice = $_POST['price'];
  $strAddress = $_POST['address'];
  $strZip = $_POST['zip'];
  $strAgentName = $agent->name;
  $strAgentLastName = $agent->lastName;
  $strAgentID = $agent->id;
  $strPropertyID = uniqid();



  // echo $strPrice;
  $jProperty = new stdClass();
  $jProperty->price = intval($strPrice);
  $jProperty->img = $sUniqueImageName;
  $jProperty->address = $strAddress;
  $jProperty->zip = $strZip;
  $jProperty->agentName = $strAgentName . " " . $strAgentLastName;
  $jProperty->agentID =  $strAgentID;
  $sPropertyUniqueID = uniqid();
  $jProperty->id = $sPropertyUniqueID;
  $jProperty->marker = new stdClass();
  $jProperty->marker->geometry = new stdClass();
  $jProperty->marker->properties = new stdClass();
  $jProperty->marker->properties->iconSize = [60, 60];
  $jProperty->marker->geometry->coordinates = [12.435513, 55.728585];
  $jProperty->marker->geometry->type = "Point";
  $jProperty->marker->type = "Feature";


  // echo json_encode($jProperty);

  $sjProperties = file_get_contents(__DIR__ . '/data/properties.json');
  // echo $sjProperties;

  $jProperties = json_decode($sjProperties);
  array_push($jProperties, $jProperty);
  // $jProperties->$sPropertyUniqueID = $jProperty;
  // echo json_encode($jProperties);
  $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);
  file_put_contents(__DIR__ . '/data/properties.json', $sjProperties);

  ?>
  <a href="profile.php">Upload an other property</a>
  <!-- <a href="properties.php">View properties</a> -->

</body>

</html>