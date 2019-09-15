<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Property <?php $_GET['id'] ?></title>
</head>
<style>
  body {
    background-color: #eee5e9;

  }
</style>

<body>

  <div class="containerOneProperty">
    <div class="addressOneProperty">
      <h2 id="zipProperty"></h2>
      <h1 id="addressProperty"></h1>
    </div>
    <div class="dataOneProperty">

      <p id="priceProperty"></p>
      <p id="sizeProperty"></p>
      <p id="bedsProperty"></p>
      <p id="bathsProperty"></p>
    </div>


    <img class="mainImage" src="">
  </div>
  <div id="otherImages"></div>


</body>
<script src="js/property.js"></script>

</html>