<?php
session_start();
if (!$_SESSION) {
  header('location: login.php');
}

?>



<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <title>Update</title>
</head>

<body>

  <?php require_once(__DIR__ . '/components/nav.php'); ?>



  <?php
  $userID = $_SESSION['user']->id;

  $sjUsers = file_get_contents(__DIR__ . '/data/users.json');
  $jUsers = json_decode($sjUsers);

  foreach ($jUsers as $jUser) {
    if ($userID == $jUser->id) {
      $email = $jUser->email;
      $name = $jUser->name;
      $lastName = $jUser->lastName;
    }
  }

  if ($_POST) {
    $newEmail = $_POST['newEmail'];
    $newName = $_POST['newName'];
    $newLastName = $_POST['newLastName'];
    foreach ($jUsers as $jUser) {
      if ($userID  == $jUser->id) {
        $jUser->email = $newEmail;
        $jUser->name = $newName;
        $jUser->lastName = $newLastName;
      }
    }
    $_SESSION['user'] = $jUser;
    $sjUsers = json_encode($jUsers, JSON_PRETTY_PRINT);

    file_put_contents(__DIR__ . '/data/users.json',  $sjUsers);

    header('location:profile.php');
  }



  ?>
  <form action="" method="POST">
    <input type="text" name="newEmail" placeholder="update email" value="<?php echo $email ?>">
    <input type="text" name="newName" placeholder="update name" value="<?php echo $name ?>">
    <input type="text" name="newLastName" placeholder="update last name" value="<?php echo $lastName ?>">

    <button>UPDATE</button>
  </form>

</body>

</html>