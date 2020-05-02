<?php
require('config.php');
require('functions.php');

if ($_SESSION['username'] !== "") {
  echo h($_SESSION['username']) . "さんの退会確認ページ";
?>
<!DOCTYPE html>
<html lang="ja">
  <head><meta charset="utf-8"><title>退会確認ページ</title></head>
  <body>
    <form action="" method="POST" onsubmit="return kakunin()">
      <input type="submit" name="delete" value="退会する">
    </form>
    <script>
    function kakunin() {
      var select = confirm("本当に退会しますか？\n「OK」を押すと退会が完了致します。");
       return select;
    }
    </script>
  </body>
</html>
<?php
} else {
  header("Location: logout.php");
}

if (isset($_POST['delete'])) { // もし「退会する」が押されたらデータベースに接続して削除
  try {
    $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $db->prepare("DELETE FROM users WHERE username = :name");
    $stmt->bindParam(':name', $_SESSION['username']);
    $stmt->execute();

    header("Location: delete_kanryou.php");
  } catch (PDOException $e) {
    echo $e->getMessage();
    exit;
  }
}
