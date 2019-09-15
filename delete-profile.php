<?php
session_start();
$sUserID = $_GET['id'];
$userSessionID = $_SESSION['user']->id;
// echo $_GET['id'];
$sjUsers = file_get_contents(__DIR__ . '/data/users.json');
$jUsers = json_decode($sjUsers);


foreach ($jUsers as $jUser) {

  if ($userSessionID == $jUser->id) {
    $jUser->active = "0";
    echo $jUser->active;
  }
}



$sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);
// echo $sjProperties;
file_put_contents(__DIR__ . '/data/users.json', $sjUsers);
session_destroy();
sleep(3); //seconds, but then it is not showing delete page, just delets
header('location:index.php');
