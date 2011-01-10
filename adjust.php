<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

$db = new Db_handle($config);

session_start();

$type = $_POST['type'];
$val = $_POST['val'];
$name = $_POST['name'];
$owner = $_POST['owner'];

if($owner = $_SESSION['username']) {
  $query = $db->get_two_cond('points', '*', 'name', $name, 'creator', $owner);

  $oldval = $query[0][value];
  //instantiating offset - will determine if number is high or low
  $offset;

  if($type == 'add') {
    $val += $oldval;
    $offset = 'high';
  } else {
    $val -= $oldval;
    $offset = 'low';
  }

  echo $val;

  if(strlen($val) < 7) {
    echo 'foo';
  } else {
    echo 'The resulting value is too ' . $offset . '.';
  }
} else {
  return false;
}

/*return json_encode($query[0]);

$charcount = explode($val);

if(count($charcount) < 7) {
} 
 */
