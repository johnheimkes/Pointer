<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

$db = new Db_handle($config);

if($db->validator('users', 'username', $_POST['username']) && $db->validator('users', 'email', $_POST['email']) && isset($_POST['password'])) {
  $create = $db->createUser('users', $_POST['username'], md5($_POST['password']), $_POST['email']);

  if($create) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    header("Location: /panel/".$_POST['username']);
  } else {
    echo 'Error in handling request';
  }
} else {
  if(!$db->validator('users', 'username', $_POST['username'])) {
    echo 'That username has already been taken.<br />';
  }

  if(!$db->validator('users', 'email', $_POST['email'])) {
    echo 'That email is already registered to a user.<br />';
  }

  if(!$_POST['password']) {
    echo 'You need to fill in your password.';
  }
}
