<?php
session_start();

/*$_SESSION['username'] != $_GET['username'])*/
if(!$_SESSION['username'] || $_SESSION['username'] != $_GET['username']) {
  header("Location: /login");
}
?>
