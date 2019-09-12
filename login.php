<?php

session_start();
if ($_SESSION) {
  header("location:profile.php");
}




if ($_POST) {

  // $sUserEmail = $_POST['inputEmail'];
  // $sUserPassword = $_POST['password'];

  if (empty($_POST['inputEmail'])) {
    return;
  }
  if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (empty($_POST['password'])) {
    sendErrorMessage('email is empty', __LINE__);
    // return;
    echo 'empty';
  }
  if (strlen($_POST['password']) !== 8) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }

  $sjUsers = file_get_contents(__DIR__ . '/data/users.json');
  $jUsers = json_decode($sjUsers);

  foreach ($jUsers as $jUser) {
    // echo $jUser;
    $bl = 0;
    if ($jUser->email == $_POST['inputEmail'] && $jUser->password == $_POST['password']) {
      $bl = 1;
      echo $jUser->email;
      unset($jUser->password);
      $_SESSION['user'] = $jUser;

      header("Location:profile.php?name=$jUser->name");
    }
  }
  if ($bl == 0) {
    // return;
    header("location:login.php");
  }
  echo $_SESSION['user']->name;
  // session_start();
}

?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <script src="https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.js"></script>
  <link href="https://api.mapbox.com/mapbox-gl-js/v1.2.0/mapbox-gl.css" rel="stylesheet" />
  <title>
    Welcome at Penny Lane</title>
</head>

<body>

  <?php require_once(__DIR__ . '/components/nav.php'); ?>


  <div class="container">

    <form id="loginForm" method="POST">
      <div>
        <label for="email"><input required type="email" data-type="email" name="inputEmail" placeholder="email">
          <div class="errorMessage" id="emailDiv">Must be a valid email address</div>
        </label>
      </div>

      <div>
        <label for="password"><input required type="password" data-type="string" minlength="8" maxlength="8" name="password" placeholder="password">
          <div class="errorMessage">Password must be 8 characters</div>
        </label>
      </div>


      <button type="submit" value="submit" disabled>Log in</button>
    </form>
  </div>

  <script src="js/forms.js"></script>


</body>

</html>