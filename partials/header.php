<!DOCTYPE html>
<html lang="en" xml:lang="en">
  <head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <title>Pointer!</title>
    <meta name="Author" content="Author" />
    <meta name="Robots" content="index,all" />
    <meta name="Keywords" content="Key Words" />
    <meta name="Description" content="Descritpion" />
    <link rel="stylesheet" href="/public/css/style.css" type="text/css" media="screen" />
    <script src="/public/js/jquery.js" type="text/javascript" charset="utf-8"></script>
    <script src="/public/js/application.js" type="text/javascript" charset="utf-8"></script>
  </head>
  <body>
    <div id="wrapper">
      <div id="header">
        <?php
          session_start();          

          if(isset($_SESSION['username'])) {
            echo '<h1><a href="/' . $_SESSION['username'] . '">Pointer - Keep track of your friends\' loyalty by awarding them points!</a></h1>';
          } else {
            echo '<h1><a href="/login">Pointer - Keep track of your friends\' loyalty by awarding them points!</a></h1>';
          }
        ?>
        <div id="nav">
          <ul id="sub">
          <?php

          if(isset($_SESSION['username'])) {
            echo '<li><a href="/logout">Sign Out</a></li>';
          } else {
            echo '<li><a href="/login">Sign In</a></li>';
            echo '<li><a href="/register">Register</a></li>';
          }
          ?>
          </ul>
        </div>
      </div>
      <div id="content">
