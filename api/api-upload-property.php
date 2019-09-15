
<?php

session_start();
$agent = $_SESSION['user'];


// print_r($_POST);

// print_r($_FILES);
// echo print_r($_FILES);

if ($_POST) {

  if (empty($_POST['price'])) {
    header('location:profile.php');
    exit;
  }
  if (empty($_POST['size'])) {
    header('location:profile.php');
    exit;
  }
  if (empty($_POST['street'])) {
    header('location:profile.php');
    exit;
  }
  if (empty($_POST['number'])) {
    header('location:profile.php');
    exit;
  }
  if (empty($_POST['bed'])) {
    header('location:profile.php');
    exit;
  }
  if (empty($_POST['bath'])) {
    header('location:profile.php');
    exit;
  }
  if (empty($_POST['zip'])) {
    header('location:profile.php');
    exit;
  }


  $iNumberOfImages = count($_FILES['imageProperty']['name']);


  $arrayImgs = [];
  for ($i = 0; $i < $iNumberOfImages; $i++) {

    $sImageName = $_FILES['imageProperty']['name'][$i];
    // echo $sImageName;
    $sImageSize = $_FILES['imageProperty']['size'][$i];
    // echo $sImageSize;
    $sTmpPath = $_FILES['imageProperty']['tmp_name'][$i];

    // echo $sTmpPath;
    $extension = pathinfo($_FILES['imageProperty']['name'][$i])['extension'];
    $sUniqueImageName = uniqid() . '.' . $extension;
    move_uploaded_file($sTmpPath, __DIR__ . "/../img/$sUniqueImageName");
    // echo $sUniqueImageName;
    array_push($arrayImgs, $sUniqueImageName);
    // echo json_encode($arrayImgs);
  }




  // move_uploaded_file($_FILES['imageProperty']['tmp_name'], __DIR__ . "/img/$sUniqueImageName");

  $strPrice = $_POST['price'];
  $strStreet = $_POST['street'];
  $strNumber = $_POST['number'];
  $strBeds = $_POST['bed'];
  $strBath = $_POST['bath'];
  $strZip = $_POST['zip'];
  $strSize = $_POST['size'];
  $strAgentName = $agent->name;
  $strAgentLastName = $agent->lastName;
  $strAgentID = $agent->id;
  $strPropertyID = uniqid();



  // echo $strPrice;
  $jProperty = new stdClass();
  $jProperty->price = intval($strPrice);
  $jProperty->img = $arrayImgs;
  // echo $jProperty->img;
  $jProperty->street = $strStreet;
  $jProperty->number = $strNumber;
  $jProperty->bed = $strBeds;
  $jProperty->bath = $strBath;
  $jProperty->size = $strSize;
  $jProperty->zip = $strZip;
  $jProperty->agentName = $strAgentName . " " . $strAgentLastName;
  $jProperty->agentID =  $strAgentID;
  $sPropertyUniqueID = uniqid();
  $jProperty->id = $sPropertyUniqueID;
  $jProperty->marker = new stdClass();
  $jProperty->marker->geometry = new stdClass();
  $jProperty->marker->properties = new stdClass();
  $jProperty->marker->properties->iconSize = [60, 60];
  $jProperty->marker->geometry->coordinates = [(float) (12.55 . rand(1000, 9999)), (float) (55.70 . rand(1000, 9990))];
  // echo json_encode($jProperty->marker->geometry->coordinates);
  $jProperty->marker->geometry->type = "Point";
  $jProperty->marker->type = "Feature";



  // echo json_encode($jProperty);

  $sjProperties = file_get_contents(__DIR__ . '/../data/properties.json');
  // echo $sjProperties;

  $jProperties = json_decode($sjProperties);
  array_push($jProperties, $jProperty);
  // $jProperties->$sPropertyUniqueID = $jProperty;
  // echo json_encode($jProperties);
  $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);
  file_put_contents(__DIR__ . '/../data/properties.json', $sjProperties);
  // sleep(3);
  // header('location:profile.php');
  echo '{"status":1, "message": "Property uploaded"}';
}
