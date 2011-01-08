<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

session_start();

if(isset($_SESSION['username'])) {
  header('Location: /panel/' . $_SESSION['username']);
}
?>

<?php
include 'partials/header.php';
?>

<h2>Please sign in</h2>
<form action="login.action.php" method="POST">
  <label for="uname">Username: </label><input type="text" id="uname" name="uname" value="" />
  <label for="pass">Password: </label><input type="password" id="pass" name="pass" value="" />
</form>
<p>If you do not have an account, please sign up <a href="/register">here</a>.</p>

<?php
include 'partials/footer.php';
?>
