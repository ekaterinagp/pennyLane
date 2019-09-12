<?php

session_start();
// print_r($_FILES);
$aAllowedExtensions = ['gif', 'jpg', 'jpeg', 'png'];
$extension = pathinfo($_FILES['img']['name'])['extension'];
$extension = strtolower($extension);
if (!in_array($extension, $aAllowedExtensions)) {
  sendError('the file must be an png, gif, jpg or jpeg', __LINE__);
}
$sUniqueImageName = uniqid() . '.' . $extension;

move_uploaded_file($_FILES['img']['tmp_name'], __DIR__ . "/../img/$sUniqueImageName");

$_SESSION['user']->img = $sUniqueImageName;

$sjUsers = file_get_contents(__DIR__ . '/../data/users.json');
// echo $sjProperties;

$jUsers = json_decode($sjUsers);

foreach ($jUsers as $jUser) {
  if ($jUser->id == $_SESSION['user']->id) {
    $jUser->img = $sUniqueImageName;

    $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__ . '/../data/users.json', $sjUsers);
    $userImg = $jUser->img;
    // echo $userImg;
    echo json_encode($jUser);
    // echo "success";
  }
}

// echo json_encode($jUsers);



function sendError($txtError, $iLineNumber)
{
  echo '{"status":0, "message":"' . $txtError . '", "line":' . $iLineNumber . '}';
  exit;
}
