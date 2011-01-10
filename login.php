<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

session_start();
unset($_SESSION['username']);

if(isset($_SESSION['username'])) {
  header('Location: /panel/' . $_SESSION['username']);
}
?>

<?php
include 'partials/header.php';

?>

<h2>sign in <span class="sub">If you do not have an account, please sign up <a href="/register">here</a>.</span></h2>
<?php
if(isset($_SESSION['err'])) {
  echo '<div id="err">';
  echo $_SESSION['err'];
  echo '</div>';

  unset($_SESSION['err']);
}

if(isset($_SESSION['succ'])) {
  echo '<div id="succ">';
  echo $_SESSION['succ'];
  echo '</div>';

  unset($_SESSION['succ']);
}
?>
<form action="login.action.php" method="POST">
  <label for="uname">Username: </label><input type="text" id="uname" name="uname" value="" />
  <label for="pass">Password: </label><input type="password" id="pass" name="pass" value="" />
  <input type="submit" id="submit" value="login" name="submit" />
</form>

<?php
include 'partials/footer.php';
?>
