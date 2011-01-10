<?php
include 'db.info.php';
require_once 'classes/db.handle.php';

session_start();

/*$_SESSION['username'] != $_GET['username'])*/
if(!$_SESSION['username'] || $_SESSION['username'] != $_GET['username']) {
  header("Location: /login");
}

$db = new Db_handle($config);
$res = $db->get('points', '*', 'creator', $_SESSION['username'], 'value', 'DESC');
?>

<?php
include 'partials/header.php';
?>
<h2>Welcome, <span><?php echo $_SESSION['username']; ?></span></h2>

<form action="add.person.php" method="POST" id="add_person">
  <label for="t_name">Twitter Handle</label><input type="text" name="t_name" value="@baoist" id="t_name">
  <label for="points">Initial Points</label><input type="text" name="points" value="" id="points">
  <input type="submit" name="submit" value="Add Person" id="submit">
</form>
<div class="people">
<?php
if($res) echo '<h2>Standings</h2>';

foreach($res as $person) { ?>

<div class="person">
  <h3><a href="http://twitter.com/<?=$person['name']?>" target="_new"><?= $person['name']?></a></h3>
  <!--<img src="' . $person['icon'] . '" /> -->
  <img src="/public/images/filler_icon.png" />
  <p><?= $person['value']?></p>
</div>
<div class="person_counter">
  <div class="controls">
    <a href="#" class="add">+</a>
    <a href="#" class="sub">-</a>
  </div>
  <form action="adjust.php?name" method="POST">
    <input type="text" value="25" name="val" id="val" class="" /> 
    <input type="hidden" value="<?=$person['name'];?>" name="name" id="name" />
    <input type="hidden" value="<?=$_SESSION['username'];?>" name="owner" id="owner"?>
  </form>
</div>

<?php
}
?>
</div>

<?php
include 'partials/footer.php';
?>
