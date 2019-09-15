<?php
// error_reporting(0);
// @ini_set('display_errors', 0);

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
  <?php
  $sActive = 'Profile';
  require_once(__DIR__ . '/components/nav.php'); ?>

  <div class="gridContainer">
    <div id="profileContainer">
      <div class="containerForProfileFunctions">
        <a href="logout.php">LOGOUT</a>
        <a href="update-profile.php">Update profile</a>
        <!-- <a href='delete-profile.php?id='> <button id="deleteProfile">Delete profile</button></a> -->

        <?php
        echo '

      <a href="delete-profile.php?id= ' . $_SESSION['user']->id . '"> Delete profile</a></div>
<div class="imgAndData">
 <div> <div id="imgProfile" style="background-image: url(img/' . $_SESSION['user']->img . ')"></div>
   <form  enctype="multipart/form-data" method="POST" id="uploadImg" ><input type="file" name="img" /><button  >Update image</button></form></div>
   <div class="personalDetails"> <h1 class="profileWelcome">Welcome ' . $_SESSION['user']->name . ' ' . $_SESSION['user']->lastName . '  </h1>
   <h2 class="idProfile"> id : ' . $_SESSION['user']->id . ' </h2>
   <h2 class="idProfile">email: ' . $_SESSION['user']->email . '</h2></div></div>
 
  
  ';

        ?>

      </div>

      <?php
      if ($_SESSION['user']->userType == "agent") {
        include_once(__DIR__ . '/components/ifAgent.php');
        ?>


      <?php
      } else {
        // NOT AGENT
        include_once(__DIR__ . '/components/ifUser.php');
        ?>

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