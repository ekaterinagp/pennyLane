<?php



//if user already logged in
// if (session_id()) {
//   exit;
// }

if ($_POST) {

  if (empty($_POST['inputEmail'])) {
    sendErrorMessage('email is empty', __LINE__);
  }
  if (!filter_var($_POST['inputEmail'], FILTER_VALIDATE_EMAIL)) {
    sendErrorMessage('email is invalid', __LINE__);
  }

  if (empty($_POST['password'])) {
    sendErrorMessage('password is empty', __LINE__);
  }

  if (strlen($_POST['password']) !== 8) {
    sendErrorMessage('password should be 8 characters', __LINE__);
  }




  $strName = $_POST['inputName'];
  $strEmail = $_POST['inputEmail'];
  $strLastName = $_POST['inputLastName'];
  $strPassword = $_POST['password'];
  $strUserType = $_POST['userType'];

  // if ($strUserType !== "agent" || $strUserType !== "user") {
  //   sendErrorMessage('user type is not found', __LINE__);
  // }

  $jsonUser = new stdClass();

  $jsonUser->email = $strEmail;
  $jsonUser->name = $strName;
  $jsonUser->lastName = $strLastName;
  $jsonUser->password = $strPassword;
  $jsonUser->userType = $strUserType;
  $jsonUser->id = uniqid();



  $sDataUsers = file_get_contents(__DIR__ . '/../data/' . $strUserType . 's.json');
  $jDataUsers = json_decode($sDataUsers);
  array_push($jDataUsers, $jsonUser);
  // session_start();
  $sDataUsers = json_encode($jDataUsers, JSON_PRETTY_PRINT);
  file_put_contents(__DIR__ . '/../data/' . $strUserType . 's.json', $sDataUsers);
  // header("location:profile.php?name=$strName");

  echo "user added";
}

function sendErrorMessage($txtError, $iLineNumber)
{
  echo '{"status":0, "message":"' . $txtError . '", "line":' . $iLineNumber . '}';
  exit;
}
