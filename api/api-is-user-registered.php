<?php

$sUsers = file_get_contents(__DIR__ . '/../data/users.json');

$jSUsers = json_decode($sUsers);

$urlEmail = $_GET['email'];

foreach ($jSUsers as $jsUser) {
  if ($urlEmail == $jsUser->email) {
    echo "true";
    exit;
  }
}
echo "false";
