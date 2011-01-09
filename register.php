<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

$db = new Db_handle($config);

if($db->validate_uniqueness('users', 'username', $_POST['username']) && $db->validate_uniqueness('users', 'email', $_POST['email']) && isset($_POST['password']) && $db->validate_email($_POST['email'])) {
  $create = $db->create_user('users', $_POST['username'], md5($_POST['password']), $_POST['email']);

  if($create) {
    session_start();
    $_SESSION['username'] = $_POST['username'];
    header("Location: /panel/".$_POST['username']);
  } else {
    echo 'Error in handling request';
  }
} else {
  $err = array();

  if(!empty($_POST['username'])) {
    if(!$db->validate_uniqueness('users', 'username', $_POST['username'])) {
      $err[] = '<p>The username \'' . $_POST['username'] . '\' has already been taken.</p>';
    }
  } else {
    $err[] = '<p>You need to fill out a username.</p>';
  }

  if(!empty($_POST['email'])) {
    if(!$db->validate_email($_POST['email'])) {
      $err[] = '<p>\'' . $_POST['email'] . '\' is not a valid email address.</p>';
    }

    if(!$db->validate_uniqueness('users', 'email', $_POST['email'])) {
      $err[] = '<p>The email address \'' . $_POST['email'] . '\' is already registered to a user.</p>';
    }
  } else {
    $err[] = '<p>You need to fill out an email address.</p>';
  }

  if(!$_POST['password']) {
    $err[] = '<p>You need to fill in your password.</p>';
  }

  session_start();
  $_SESSION['err'] = $err;

  header("Location: /register");
}
