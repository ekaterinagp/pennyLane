<?php
if (empty($_GET['search']) && $_GET['search'] !== '0') {

  echo '[]';
  exit;
}

// if(!isset($_GET['search'])){
//   echo '[]';
//   exit;
// } //also a solution, but it gives en error in ajax

$sSearchFor = $_GET['search'];

$sjProperties = file_get_contents(__DIR__ . "/../data/properties.json");
$jProperties = json_decode($sjProperties);

// echo json_encode($jProperties);
// echo "the user is searching for {$sSearchFor}";

$matches = [];

foreach ($jProperties as $jProperty) {


  if (strpos($jProperty->zip, $sSearchFor) !== false) {
    array_push($matches, $jProperty);
  }
}
echo json_encode($matches);
