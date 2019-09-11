<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Welcome <?php echo $_GET['name']; ?></title>
</head>

<body>
  <?php
  session_start();
  if (!$_SESSION) {
    header('location: login.php');
  }

  if (!$_GET['name']) {
    header('location: signup.php');
  }
  echo "welcome profile {$_GET['name']} ";
  ?>

  <a href="logout.php">LOGOUT</a>
</body>

</html>