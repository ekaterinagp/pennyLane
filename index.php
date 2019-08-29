<?php

$pageTitle='Home';
$sScriptName="one.js";
// ini_set('display_errors',0); to hide all the errors
require_once(__DIR__.'/components/top.php');
?>





<div class="container">
<div id="map"></div>

<div class="properties">

<!-- <div class="property">
<img src="img/1.jpg">
<div class="priceGrid">
<div>$321244</div>
<div>5 beds |</div><div>3 bath |</div><div>100 m2 </div>
</div>

<div class="address"></div>
<div class="saler"><div class="roundDot"></div></div>
</div> -->
<?php
$strJProperties=file_get_contents('properties.json');
$jProperties=json_decode($strJProperties);

foreach($jProperties as $jProperty){
  // echo '<div class="property">
  // <img src="img/'.$jProperty->image.'">
  // <div>$'.$jProperty->price.'</div>
  // </div>';

  echo '<div class="property">
  <img src="img/'.$jProperty->image.'">
  <div class="priceGrid">
  <div>$'.$jProperty->price.'</div>
  <div>'.$jProperty->beds.' beds |</div><div>'.$jProperty->bath.' bath |</div><div>'.$jProperty->meters.' m2 </div></div><div class="address">'.$jProperty->address.'</div><div class="saler"><div class="roundDot"></div>'.$jProperty->saler.'</div>
  </div>';
}

?>
<div class="property"></div>
<div class="property"></div>
<div class="property"></div>
<div class="property"></div>
<div class="property"></div>
<div class="property"></div>
<div class="property"></div>
</div>
</div>

<?php
require_once(__DIR__.'/components/footer.php');
?>
