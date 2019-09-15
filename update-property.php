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



  <?php
  $sPropertyID = $_GET['id'];
  $sjProperties = file_get_contents(__DIR__ . '/data/properties.json');
  $jProperties = json_decode($sjProperties);

  foreach ($jProperties as $jProperty) {
    if ($_GET['id'] == $jProperty->id) {
      $price = $jProperty->price;
    }
  }

  if ($_POST) {
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
      move_uploaded_file($sTmpPath, __DIR__ . "/img/$sUniqueImageName");
      // echo $sUniqueImageName;
      array_push($arrayImgs, $sUniqueImageName);
      echo json_encode($arrayImgs);
    }






    $newPrice = $_POST['newPrice'];
    foreach ($jProperties as $jProperty) {
      if ($sPropertyID == $jProperty->id) {
        $jProperty->price = $newPrice;
        $jProperty->img = $arrayImgs;
      }


      $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);

      file_put_contents(__DIR__ . '/data/properties.json', $sjProperties);

      header('location:profile.php');
    }
  }



  ?>

  <form action="" method="POST" enctype="multipart/form-data">
    <input type="text" name="newPrice" placeholder="enter new price" value="<?php echo  $price ?>">


    <input type="file" name="imageProperty[]" multiple>
    <button>UPDATE</button>
  </form>




</body>

</html>