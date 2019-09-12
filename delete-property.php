<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Delete</title>
</head>

<body>
  <h1>It is deleted: <?= $_GET['id']
                      ?>
  </h1>

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

  sleep(3); //seconds, but then it is not showing delete page, just delets
  header('location:profile.php');
  ?>
</body>

</html>