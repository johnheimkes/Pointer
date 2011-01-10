
<?php
include 'partials/header.php';

echo '<h2>Register</h2>';

session_start();
if(isset($_SESSION['err'])) {
  echo '<div id="err">';
  foreach($_SESSION['err'] as $err) {
    echo $err;
  }
  echo '</div>';
  unset($_SESSION['err']);
}
?>

<form action="register.php" method="POST" accept-charset="utf-8">
  <label for="username">Username</label><input type="text" name="username" value="" id="username">
  <label for="email">Email</label><input type="text" name="email" value="" id="email">
  <label for="password">Password</label><input type="password" name="password" value="" id="password">
  <input type="submit" id="submit" class="reg" name="register" value="Register" />
</form>

<?php
include 'partials/footer.php';
?>
