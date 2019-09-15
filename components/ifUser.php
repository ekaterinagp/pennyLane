<div id="propertiesLiked">
  <h2>You liked these properties</h2>
  <?php
  $sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
  $jUsers = json_decode($sjUsers);

  $sjProperties = file_get_contents(__DIR__ . '/../data/properties.json');
  $jProperties = json_decode($sjProperties);

  foreach ($jUsers as $jUser) {

    if ($jUser->id == $_SESSION['user']->id) {

      if (!empty($jUser->liked)) {
        foreach ($jUser->liked as $like) {


          foreach ($jProperties as $jProperty) {
            if ($like == $jProperty->id) {
              // echo "here is a match $like";
              $strBluePrint = '<div class="property">
             <div class="linksUserProfile"> <a href="property.php?id={{id}}" id="detailsBtn">Details</a><a href ="delete-property-from-likes.php?id={{id}}">Delete {{street}}{{number}} from your list</a></div>
              <div class="imgUser" style="background-image: url(img/{{path}})"></div>
              <div class="bbs "> <div class="priceIndex borderSeparator "> {{price}} dkk</div>
    
              <div class="borderSeparator alignText">Bds {{bed}} </div>
              <div class="borderSeparator alignText">Ba {{bath}} </div>
              <div class="sizeIndex alignText" > {{size}} m2</div></div>
         
         <div class="addressGridIndex">    <p> {{zip}} {{street}}{{number}} </p>
               
             
            
              <button class="sendPropertyByEmail" id="{{id}}">Send this by email</button>
               
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
        }
      }
      // foreach ($jProperty->img as $img) {
      //   $bluePrintForImgs = '<img src="img\{{path}}">';
      // }

      // $strBluePrint = '<div class="property">

      // <img src="img\{{path}}">

      //   <div>ZIP {{zip}}</div>
      //   <div>ADDRESS {{address}}</div>
      //   <div>PRICE {{price}} dkk</div>
      //   <a href="property.php?id={{id}}" id="detailsBtn">Details</a>
      //   <button><a href="delete-property.php?id={{id}}">Delete</a></button>
      //   <button><a href="update-property.php?id={{id}}">Update</a></button>
      // </div>';

      // $sCopyBluePrint = $strBluePrint;
      // $sCopyBluePrint = str_replace('{{price}}', $jProperty->price, $sCopyBluePrint);
      // $sCopyBluePrint = str_replace('{{path}}', $jProperty->img[0], $sCopyBluePrint);
      // $sCopyBluePrint = str_replace('{{address}}', $jProperty->address, $sCopyBluePrint);
      // $sCopyBluePrint = str_replace('{{zip}}', $jProperty->zip, $sCopyBluePrint);
      // $sCopyBluePrint = str_replace('{{id}}', $jProperty->id, $sCopyBluePrint);

      // echo $sCopyBluePrint;
    }
  }

  ?>
</div>