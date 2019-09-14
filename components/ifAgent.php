<div id="uploadProperty">
  <h2>Upload new property</h2>
  <form action="upload-property.php" method="POST" enctype="multipart/form-data">

    <input type="file" name="imageProperty[]" multiple>
    <input type="text" placeholder="price" name="price">
    <input type="text" placeholder="address" name="address">
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
      
        <div>ZIP {{zip}}</div>
        <div>ADDRESS {{address}}</div>
        <div>PRICE {{price}} dkk</div>
        <a href="property.php?id={{id}}" id="detailsBtn">Details</a>
        <button><a href="delete-property.php?id={{id}}">Delete</a></button>
        <button><a href="update-property.php?id={{id}}">Update</a></button>
      </div>';

      $sCopyBluePrint = $strBluePrint;
      $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{path}}', $jProperty->img[0], $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{address}}', $jProperty->address, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{zip}}', $jProperty->zip, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{id}}', $jProperty->id, $sCopyBluePrint);

      echo $sCopyBluePrint;
    }
  }

  ?>


</div>