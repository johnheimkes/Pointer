<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

session_start();

$db = new Db_handle($config);
if($_GET['username']) {
  $res = $db->get('points', '*', 'creator', $_GET['username']);
} else {
  $res = $db->get('points', '*', 'creator', 'baoist');
  $err = '<h2>You neglected to put a username in, so I directed you to my point tracker.</h2>';
}
?>

<?php
include 'partials/header.php';
?>

<?php
if($err) echo $err;

foreach($res as $point) {
  echo '<div class="person">';
  echo '<p><a target="_new" href="http://twitter.com/"' . $point['name'] . '">' . $point['name'] . '</a></p>';
  echo '<p>' . $point['value'] . '</p>';
  echo '</div>';
}
?>

<?php
include 'partials/footer.php';
?>
