<?php
session_start();
if (!$_SESSION) {
  header('location: login.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Welcome <?php echo $_SESSION['user']->name; ?></title>
</head>

<body>
  <?php require_once(__DIR__ . '/components/nav.php'); ?>

  <div class="gridContainer">
    <div id="profileContainer">
      <?php
      echo '
  <h1>Welcome ' . $_SESSION['user']->name . ' </h1>
  <h2> id : ' . $_SESSION['user']->id . ' </h2>
  <h2>email: ' . $_SESSION['user']->email . '</h2>
  <div class="fullName">
    <h2>name: ' . $_SESSION['user']->name . '</h2>
    <h2>last name: ' . $_SESSION['user']->lastName . '</h2>
  </div>
  <img id="imgProfile" src="img/' . $_SESSION['user']->img . '" alt=""> <form  enctype="multipart/form-data" method="POST" id="uploadImg" ><input type="file" name="img" /><button  >Upload image</button></form>
  
  ';

      ?>
      <button id="deleteProfile">Delete profile</button>
      <a href="logout.php"><button>LOGOUT</button></a>
    </div>

    <?php
    if ($_SESSION['user']->userType == "agent") {
      include_once(__DIR__ . '/components/ifUserAgent.php');
      ?>
      <!-- <div id="uploadProperty">
        <h2>Upload new property</h2>
        <form action="upload-property.php" method="POST" enctype="multipart/form-data">

          <input type="file" name="imageProperty">
          <input type="text" placeholder="price" name="price">
          <input type="text" placeholder="address" name="address">
          <input type="text" placeholder="zip" name="zip">

          <button>Upload property</button>
        </form>
      </div>
  </div>
  <h2>Your properties</h2>
  <div id="agentProperties">

  
  </div> -->

    <?php
    } else {
      // NOT AGENT
      ?>
      NOT AN AGENT
    <?php
    }
    // if (!$_GET['email']) {
    //   header('location: signup.php');
    // }
    // echo "welcome profile {$_GET['name']} ";


    ?>






    <script src="js/profile.js"></script>
</body>

</html>