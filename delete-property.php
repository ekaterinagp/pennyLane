

  <?php
  session_start();
  $sPropertyID = $_GET['id'];
  $sjProperties = file_get_contents(__DIR__ . '/data/properties.json');
  $jProperties = json_decode($sjProperties);


  foreach ($jProperties as $index => $jProperty) {
    if ($_SESSION['user']->id === $jProperty->agentID) {
      if ($sPropertyID == $jProperty->id) {
        array_splice($jProperties, $index, 1);
      }
    }
  }



  $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);
  // echo $sjProperties;
  file_put_contents(__DIR__ . '/data/properties.json', $sjProperties);
  echo '{"status":1, "message": "Property deleted"}';
  sleep(3); //seconds, but then it is not showing delete page, just delets
  header('location:profile.php');
