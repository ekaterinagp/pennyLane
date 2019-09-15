<?php



//uncomment when done
session_start();
if ($_SESSION) {
  header("location:profile.php");
}

if ($_POST) {
  if (empty($_POST['inputEmail'])) {
    return;
  }
  if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (empty($_POST['inputName'])) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (strlen($_POST['inputName']) < 2) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (strlen($_POST['inputName']) > 20) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (empty($_POST['inputLastName'])) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (strlen($_POST['inputLastName']) < 2) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (strlen($_POST['inputLastName']) > 20) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (empty($_POST['password'])) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (strlen($_POST['password']) !== 8) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }
  if (!$_POST['userType']) {
    sendErrorMessage('email is empty', __LINE__);
    return;
  }



  $strName = $_POST['inputName'];
  $strLastName = $_POST['inputLastName'];
  $strEmail = $_POST['inputEmail'];
  $strPassword = $_POST['password'];
  $strUserType = $_POST['userType'];

  $user = new stdClass();


  $user->name = $strName;
  $user->lastName = $strLastName;
  $user->email = $strEmail;
  $user->password = $strPassword;
  $user->userType = $strUserType;
  $user->img = 'default.png';
  $user->id = uniqid();
  $user->active = "1";
  if ($strUserType == "user") {
    $user->liked = [];
  }



  $sDataUsers = file_get_contents(__DIR__ . '/data/users.json');
  $jDataUsers = json_decode($sDataUsers);
  array_push($jDataUsers, $user);

  $sDataUsers = json_encode($jDataUsers, JSON_PRETTY_PRINT);
  file_put_contents(__DIR__ . '/data/users.json', $sDataUsers);

  unset($user->password);
  session_start();
  $_SESSION['user'] = $user;
  header("location:profile.php?name=$strName");
}

function sendErrorMessage($txtError, $iLineNumber)
{
  echo '{"status":0, "message":"' . $txtError . '", "line":' . $iLineNumber . '}';
  exit;
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

  <?php
  $sActive = 'Signup';
  require_once(__DIR__ . '/components/nav.php'); ?>


  <div class="container">
    <div class="loginWelcome">
      <h1>Welcome to Penny Lane!</h1>
      <h2>Please sign up</h2>
    </div>
    <form id="signupForm" method="POST">

      <div class="labels"> <label for="user"><input type="radio" value="user" name="userType">Sign up as a user</label>
        <label for="agent"><input type="radio" value="agent" name="userType">Sign up as an agent</label></div>
      <div>
        <label for="name"><input required minlength="2" maxlength="20" type="text" data-type="string" name="inputName" placeholder="First name">
          <div class="errorMessage">Name must be more than 1 and less than 20 letters</div>
        </label>
      </div>

      <div>
        <label for="lastName"><input required data-type="string" minlength="2" maxlength="20" type="text" name="inputLastName" placeholder="Last name">
          <div class="errorMessage">Last name must be more than 1 and less than 20 letters</div>
        </label>
      </div>

      <div>
        <label for="email"><input required type="email" data-type="email" name="inputEmail" onchange="fvIsEmailAvailable(this);" placeholder="email">
          <div class="errorMessage" id="emailDiv">Must be a valid email address</div>
        </label>
      </div>

      <div>
        <label for="password"><input required type="password" data-type="string" minlength="8" maxlength="8" name="password" placeholder="password">
          <div class="errorMessage">Password must be 8 characters</div>
        </label>
      </div>


      <button type="submit" value="submit" disabled>Sign Up</button>
    </form>
  </div>

  <script src="js/forms.js"></script>


</body>





</html>