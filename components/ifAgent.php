<div id="uploadProperty">
  <h2>Upload new property</h2>
  <form action="upload-property.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="imageProperty[]" multiple>
    <input type="text" placeholder="price" name="price">
    <input type="text" placeholder="m2" name="size">
    <input type="text" placeholder="street" name="street">
    <input type="text" placeholder="number" name="number">
    <input type="text" placeholder="bedrooms" name="beds">
    <input type="text" placeholder="bathrooms" name="bath">
    <input type="text" placeholder="zip" name="zip">

    <button>Upload property</button>
  </form>
</div>
</div>
<h2>Your properties</h2>
<div id="agentProperties">

  <?php
  $sjProperties = file_get_contents(__DIR__ . '/../data/properties.json');
  $jProperties = json_decode($sjProperties);

  foreach ($jProperties as $jProperty) {

    if ($jProperty->agentID == $_SESSION['user']->id) {


      // foreach ($jProperty->img as $img) {
      //   $bluePrintForImgs = '<img src="img\{{path}}">';
      // }

      $strBluePrint = '<div class="property">
        
      <img src="img\{{path}}">
      <div>price {{price}}</div>
        <div>zip {{zip}}</div>
        <div>Address {{street}}{{number}}</div>
        <div>Size {{size}} m2</div>
        <div>Bedrooms {{beds}} </div>
        <div>Bathrooms {{bath}} </div>
        <a href="property.php?id={{id}}" id="detailsBtn">Details</a>
        <button><a href="delete-property.php?id={{id}}">Delete</a></button>
        <button><a href="update-property.php?id={{id}}">Update</a></button>
      </div>';

      $sCopyBluePrint = $strBluePrint;
      $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{path}}', $jProperty->img[0], $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{street}}', $jProperty->street, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{size}}', $jProperty->size, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{number}}', $jProperty->number, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{zip}}', $jProperty->zip, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{beds}}', $jProperty->bed, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{bath}}', $jProperty->bath, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{id}}', $jProperty->id, $sCopyBluePrint);

      echo $sCopyBluePrint;
    }
  }

  ?>


</div>