<?php
session_start();
if (!$_SESSION) {
  header('location: login.php');
}

?>



<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Update</title>
</head>

<body>

  <?php require_once(__DIR__ . '/components/nav.php'); ?>

  <?php


  $sPropertyID = $_GET['id'];
  echo $sPropertyID;
  $sjProperties = file_get_contents(__DIR__ . '/data/properties.json');
  $jProperties = json_decode($sjProperties);






  if ($_POST) {
    $newPrice = $_POST['newPrice'];
    foreach ($jProperties as $jProperty) {
      if ($sPropertyID == $jProperty->id) {
        $jProperty->price = $newPrice;
      }
    }

    $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);

    file_put_contents(__DIR__ . '/data/properties.json', $sjProperties);

    header('location:profile.php');
  }



  ?>

  <form action="" method="POST">
    <input type="text" name="newPrice" placeholder="enter new price" value="">
    <button>UPDATE</button>
  </form>




</body>

</html>