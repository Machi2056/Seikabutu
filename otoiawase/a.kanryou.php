<?php

session_start();

require_once('a.class.php');

$kanryou = new Post;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>完了画面</title>
  <link rel="stylesheet" href="a.styles.css">
</head>
<body>
  <h1>お問い合わせ完了</h1>
  <p>送信しました</p>
  <table border="1px, solid, silver">
    <tr>
      <td>名前</td>
      <td><?php if (isset($_SESSION['name'])) { echo $_SESSION['name']; } ?></td>
    </tr>
    <tr>
      <td>年齢</td>
      <td><?php if (isset($_SESSION['old'])) { echo $_SESSION['old'] . '  歳'; } ?></td>
    </tr>
    <tr>
      <td>好きな色</td>
      <td><?php if (isset($_SESSION['color'])) { echo $_SESSION['color']; } ?></td>
    </tr>
  </table>
</body>
</html>
