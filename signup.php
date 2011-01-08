<?php
include 'partials/header.php'
?>

<form action="register.php" method="POST" accept-charset="utf-8">
  <label for="username">Username</label><input type="text" name="username" value="" id="username">
  <label for="email">Email</label><input type="text" name="email" value="" id="email">
  <label for="password">Password</label><input type="password" name="password" value="" id="password">
  <input type="submit" id="register" name="register" value="Register" />
</form>

<?php
include 'partials/footer.php'
?>
