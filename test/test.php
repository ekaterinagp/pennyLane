<?php


$name = $_POST['name'];


if (strlen($name) > 2) {
  echo "name is more than 2 chr";
} else {
  echo "name is less than 2 chr";
}
session_start();
$_SESSION['name'] = $name;
echo $_SESSION['name'];

session_destroy();
// $name = "Katya";

// $uniqueID = uniqid();

// $test = [];

// array_push($test, $name);

// echo json_encode($test);

// $name = $_GET['name'];
// echo $name;

// $user = $_GET['name'];

// $user = new stdClass();

// $user->name = $_GET['name'];

// $myName = 'Katya';
// $myLastName = 'Gerhardt-Pedersen';
// $year = '2019';

// echo "hi {$_POST['name']} {$_POST['lastName']} , the year is {$_POST['year']}";
