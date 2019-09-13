<?php
session_start();
if (!$_SESSION) {
  sendError('no user signed in', __LINE__);
}
if ($_SESSION['user']->userType !== 'user') {
  sendError('not a user', __LINE__);
}
if (empty($_GET['id'])) {
  sendError('no data', __LINE__);
}

$propertyId = $_GET['id'];

$sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
$jUsers = json_decode($sjUsers);

foreach ($jUsers as $jUser) {
  if ($_SESSION['user']->id == $jUser->id) {

    if (in_array($propertyId, $jUser->liked)) {
      $index;

      for ($x = 0; $x < count($jUser->liked); $x++) {
        if ($jUser->liked[$x] == $propertyId) {
          $index = $x;
        }
      }


      array_splice($jUser->liked, $index, 1);
      echo json_encode($jUser);
    } else {
      array_push($jUser->liked, $propertyId);
      echo json_encode($jUser);
    }
    //   // $index = array_search($propertyId, $jUser->liked);
    //   // array_splice($jUser->liked, $index, 1);
    // } else
  }
}


$sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
file_put_contents(__DIR__ . '/../data/users.json', $sjUsers);
// echo '{"status":1, "message": "Property liked", "line":' . __LINE__ . '}';



function sendError($message, $line)
{
  echo '{"status":0, "message":"' . $message . '", "line":"' . $line . '"}';
  exit;
}
