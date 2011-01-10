<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

$name = $_POST['t_name'];
$val = $_POST['points'];

if($val == '') {
  $val = 0;
}

session_start();

if(strlen($val) < 7 && is_numeric($val)) {
  //if a twitter handle begins with @ it the @ is removed.
  if($name[0] == '@') {
    $name = substr($name, 1);
  }

  $jsonurl = "http://api.twitter.com/1/users/show.json?screen_name=" . $name;
  $json = file_get_contents($jsonurl,0,null,null);
  if($json) {
    $json = json_decode($json, true);
    
    $img = $json['profile_image_url'];

    $db = new Db_handle($config);

    if(!$db->check_user('points', 'name', $name, 'creator', $_SESSION['username'])) {
      $create = $db->create_person("points", "(name, creator, value, icon)", "('" . $name . "', '" . $_SESSION['username'] . "', '" . $val . "', '" . $img . "')");
    } else {
      $_SESSION['err'] = '<p>That person already exists in your point tracker.';
    }
  } else {
    $_SESSION['err'] = '<p>Unable to find the username provided.</p>';
  }
} else {
  $_SESSION['err'] = '';

  if(!is_numeric($val)) {
    $_SESSION['err'] .= '<p>The initial points must be numeric.</p>';
  }

  if(strlen($val) < 7) {
    $_SESSION['err'] .= '<p>The initial value you tried to give was too long.</p>';
  }
}

header("Location: /panel/".$_SESSION['username']);
