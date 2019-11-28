<?php
session_start();

if (empty($_SESSION['csrf_token'])) {
  $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if ($_SESSION['acct_type'] == 'pos1') {
  header('location:views/pos1.layout.php');
  exit();

}elseif ($_SESSION['acct_type'] == 'pos2') {
  header('location:views/pos2.layout.php');
  exit();

}elseif ($_SESSION['acct_type'] == 'pos3') {
  header('location:views/pos3.layout.php');
  exit();

}else {
  header('location:main.layout.php');
  exit();
}
 ?>
