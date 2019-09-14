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
  $sPropertyToDeleteID = $_GET['id'];
  $sjUsers = file_get_contents(__DIR__ . '/data/users.json');
  $jUsers = json_decode($sjUsers);


  foreach ($jUsers as $jUser) {
    if ($_SESSION['user']->id === $jUser->id) {
      foreach ($jUser->liked as $key => $like) {
        if ($sPropertyToDeleteID  == $like) {
          array_splice($jUser->liked, $key, 1);
          $_SESSION['user']->liked = $jUser->liked;
        }
      }
    }
  }



  $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
  // echo $sjProperties;
  file_put_contents(__DIR__ . '/data/users.json', $sjUsers);

  sleep(3); //seconds, but then it is not showing delete page, just delets
  header('location:profile.php');
  ?>
</body>

</html>