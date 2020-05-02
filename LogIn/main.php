<?php
session_start();
require('functions.php');

if ($_SESSION['username'] != "") {
  $hello = "ようこそ!  " . h($_SESSION['username']) . "  さん。";
} else {
  header("Location: logout.php");
}

if (isset($_POST['logout'])) {
  $_SESSION = array();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>メインページ</title>
</head>
<body>
  <?php echo h($hello); ?>
  <form action="" method="POST">
    <input type="submit" name="logout" value="ログアウトする">
    <!-- <input type="submit" name="delete" value="退会する"> -->
  </form>
  <a href="delete.php">退会</a>はこちら。
</body>
</html>
