<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Update</title>
</head>

<body>
  <h1>Trying to update <?= $_GET['id']
                        ?>
  </h1>



  <?php


  $sPropertyID = $_GET['id'];


  // echo $jProperties->$sPropertyID->price;
  if ($_POST) {
    $newPrice = $_POST['newPrice'];
    $jProperties->$sPropertyID->price = $newPrice;
    // $aAllowedExtensions = ['gif', 'jpg', 'jpeg', 'png'];
    // $extension = pathinfo($_FILES['imageProperty']['name'])['extension'];
    // $extension = strtolower($extension);
    // if (!in_array($extension, $aAllowedExtensions)) {
    //   sendError('the file must be an png, gif, jpg or jpeg', __LINE__);
    // }
    // $sUniqueImageName = uniqid() . '.' . $extension;

    // move_uploaded_file($_FILES['imageProperty']['tmp_name'], __DIR__ . "/../img/$sUniqueImageName");

    // $sPropertyID->img = $sUniqueImageName;
    // $sjProperties = file_get_contents(__DIR__ . '/data/properties.json');
    // $jProperties = json_decode($sjProperties);
    // foreach ($jProperties as $jProperty) {
    //   if ($jProperty->id == $sPropertyID) {
    //     $jProperty->img = $sUniqueImageName;
    //   }


    $sjProperties = json_encode($jProperties, JSON_PRETTY_PRINT);

    file_put_contents(__DIR__ . '/data/properties.json', $sjProperties);
    // echo json_encode($jProperties);


    header('location:profile.php');
  }



  ?>
  <form action="" method="POST">
    <input type="text" name="newPrice" placeholder="enter new price" value="">

    <button>UPDATE</button>
  </form>
  <!-- <form method="POST" id="newImageUpload">
    <input type="file" name="imageProperty">
    <button id="newImage">Upload new image</button>
  </form> -->
</body>

</html>