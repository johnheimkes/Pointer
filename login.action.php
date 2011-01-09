<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

$db = new Db_handle($config);

$check = $db->check_user('users', 'username', $_POST['uname'], 'password', md5($_POST['pass']));

session_start();

if(!$check) {
  $_SESSION['err'] = '<p>The username and/or password you provided was invalid.</p>';
  header('Location: /login');
} else {
  $_SESSION['username'] = $_POST['uname'];
  header('Location: /panel/' . $_POST['uname']);
}
