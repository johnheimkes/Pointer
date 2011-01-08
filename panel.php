<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

session_start();

/*$_SESSION['username'] != $_GET['username'])*/
if(!$_SESSION['username'] || $_SESSION['username'] != $_GET['username']) {
  header("Location: /login");
}

$db = new Db_handle($config);
$res = $db->get('points', '*', 'creator', $_SESSION['username']);
?>

<?php
include 'partials/header.php';
?>
  <h2>Welcome, <?php echo $_SESSION['username']; ?></h2>

<div class="people">
<?php
  foreach($res as $person) {
    echo '<div class="person">';
    echo '<h3><a href="http://twitter.com/' . $person['name'] . '" target="_new">' . $person['name'] . '</a></h3>';
    echo '<p>' . $person['value'] . '</p>';
    echo '<a href="#" class="add">+</a><a href="#" class="sub">-</a>
          <form action"adjust.php?name=' . $person['name'] . '" method="POST">
            <input type="text" value="25" class="" /> 
          </form>';
    echo '</div>';
  }
?>
</div>

<?php
include 'partials/footer.php';
?>
