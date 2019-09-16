<?php

session_start();
if (!empty($_SESSION['user'])) {
  $user = $_SESSION['user'];

  echo json_encode($user);
} else {
  echo '{"status":"0"}';
}
