<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

session_start();

$db = new Db_handle($config);
if($_GET['username']) {
  $res = $db->get('points', '*', 'creator', $_GET['username'], 'value', 'DESC');
} else {
  $res = $db->get('points', '*', 'creator', 'baoist', 'value', 'DESC');
  $_GET['username'] = "Baoist";
  $err = '<h2>You neglected to put a username in, so I directed you to my point tracker.</h2>';
}
?>

<?php
include 'partials/header.php';

if($db->check_reg('users', 'username', $_GET['username'])) {
?>
  <h2><?php echo $_GET['username'];?>'s Point Tracker</h2>
<? } else { ?>
  <h2>That user wasn't found</h2>
  <p class="not_found">Please <a href="/login">log in</a> or <a href="/register">register</a>.</p>
<?php
}

if($err) echo $err;

foreach($res as $person) { ?>
<div class="person show">
  <h3><a href="http://twitter.com/<?=$person['name']?>" target="_new"><?= $person['name']?></a></h3>
  <!--<img src="' . $person['icon'] . '" /> -->
  <img src="/public/images/filler_icon.png" />
  <p><?= $person['value']?></p>
</div>
<?php
}
?>

<?php
include 'partials/footer.php';
?>
