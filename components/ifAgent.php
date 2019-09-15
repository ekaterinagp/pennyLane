<div id="uploadProperty">
  <h2 class="profileWelcome">Upload new property</h2>
  <form id="formGridUpload" method="POST" enctype="multipart/form-data">


    <input type="text" placeholder="price" name="price">
    <input type="text" placeholder="m2" name="size">
    <input type="text" placeholder="zip" name="zip">
    <input type="text" placeholder="street" name="street">
    <input type="text" placeholder="number" name="number">
    <input type="text" placeholder="bedrooms" name="bed">
    <input type="text" placeholder="bathrooms" name="bath">
    <input type="file" name="imageProperty[]" multiple>
    <button id="uploadBtnProperty"> Upload property</button>
  </form>
</div>
</div>
<h2 class="propertiesTitle">Your properties</h2>
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
     <div class="linksPropertyContainer">
     <a href="update-property.php?id={{id}}">Update {{street}} {{number}}</a>
      <a href="delete-property.php?id={{id}}">Delete {{street}} {{number}} </a>
     </div>
     <div class="imgProfileProperty" style="background-image: url(img/{{path}}) "></div>
     <div class="bbsp "> <div class="priceIndex borderSeparator "> {{price}} dkk</div>
    
        <div class="borderSeparator alignText">Bds {{bed}} </div>
        <div class="borderSeparator alignText">Ba {{bath}} </div>
        <div class="sizeIndex alignText" > {{size}} m2</div></div>
   
   <div class="addressGrid">    <p> {{zip}} {{street}} {{number}} </p> <a href="property.php?id={{id}}" id="detailsBtn">More details...</a></div>
       
        
      </div>';

      $sCopyBluePrint = $strBluePrint;
      $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{path}}', $jProperty->img[0], $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{street}}', $jProperty->street, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{size}}', $jProperty->size, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{number}}', $jProperty->number, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{zip}}', $jProperty->zip, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{bed}}', $jProperty->bed, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{bath}}', $jProperty->bath, $sCopyBluePrint);
      $sCopyBluePrint = str_replace('{{id}}', $jProperty->id, $sCopyBluePrint);

      echo $sCopyBluePrint;
    }
  }

  ?>


</div>