<?php

session_start();

if(isset($_SESSION['username'])) {
  unset($_SESSION['username']);
  $_SESSION['succ'] = '<p>You have successfully logged out.</p>';
  header('Location: /login');
}
