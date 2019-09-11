<?php
session_start();
session_destroy();

// echo '{"status":1, "message":"logged out"}';
header("location:index.php");
