<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

$db = new Db_handle($config);

session_start();

$type = $_POST['type'];
$val = $_POST['val'];
$name = $_POST['name'];
$owner = $_POST['owner'];

if($owner == $_SESSION['username'] && is_numeric($val)) {
  $query = $db->get_two_cond('points', '*', 'name', $name, 'creator', $owner);

  $oldval = $query[0][value];
  //instantiating offset - will determine if number is high or low
  $offset;

  if($type == 'add') {
    $val += $oldval;
    $offset = 'high';
  } else {
    $val = $oldval - $val;
    $offset = 'low';
  }

  if(strlen($val) < 7) {
    $update = $db->update('points', $owner, $name, $val);

    if($update) {
      echo $val;
    } else {
      echo 'Something went wrong, please try again';
    }
  } else {
    echo 'The resulting value is too ' . $offset . '.';
  }
} else {
  if(!is_numeric($val)) {
    echo 'That\'s not a number.';
  }
  return false;
}

/*return json_encode($query[0]);

$charcount = explode($val);

if(count($charcount) < 7) {
} 
 */
