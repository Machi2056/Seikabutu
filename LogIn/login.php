<?php
require('config.php');
require('functions.php');

$error_msg = "";
$name_error_msg = "";
$password_error_msg = "";
$form_data = "";
$name = "";
$pass = "";

if (isset($_POST['sub'])) { // サブミットボタンが押されたら
  $name = $_POST['name'];
  $pass = $_POST['password'];
  if (user_check($name) === true && password_check($pass) === true) { // ユーザー名とパスワードが正しく入力されていたら
    try { // データベースに接続
      $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare("SELECT COUNT(username) FROM users WHERE username = :name");// データベースからフォーム値と同じユーザーを探す
      $stmt->bindParam(':name', $name);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (in_array(1, $user)) { // ユーザー名がデータベースに存在していたらパスワードを取得
        $stmt = $db->prepare("SELECT password FROM users WHERE username = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (password_verify($pass, $row['password'])) { // 入力したパスワードが正しかったらメインページへ
          $_SESSION['username'] = $name;
          header('Location: main.php');
        } else {
          $error_msg = "ユーザー名またはパスワードが間違っています。";
          $form_data = $name;
        }
      } else {
        $error_msg = "ユーザー名またはパスワードが間違っています。";
        $form_data = $name;
      }

    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  } else {// ユーザー名またはパスワードに不備があったらエラーを表示
    if (strlen(trim($_POST['name'])) == 0) { // ユーザー名が空の時
      $name_error_msg = "ユーザー名を入力してください。";
    } elseif (!preg_match('/\A[0-9A-Za-z]+\z/', $name)) {
      $name_error_msg = "半角英数字で入力してください。";
      $form_data = $name;
    } else {
      $form_data = $name;
    }

    if (strlen(trim($_POST['password'])) == 0) { // 空の時
      $password_error_msg = "パスワードを入力してください。";
    } elseif(strlen(trim($_POST['password'])) < 8) {
      $error_msg = "ユーザー名またはパスワードが間違っています。";
      $form_data = $name;
    } else {
      $password_error_msg = "ユーザー名またはパスワードが間違っています。";
      $form_data = $name;
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>ログイン</title>
</head>
<body>
  <h1>ログイン</h1>
  <p style="color:red;"><?php echo h($error_msg) ?></p>
  <form action="" method="POST">
    <input type="text" name="name" value="<?php echo h($form_data); ?>" placeholder="ユーザー名を入力">
    <p style="color:red;"><?php echo h($name_error_msg); ?></p>
    <br>
    <input type="password" name="password" placeholder="パスワードを入力">
    <p style="color:red;"><?php echo h($password_error_msg); ?></p>
    <br>
    <input type="submit" name="sub" value="ログイン">
  </form>
  <a href="shinki.php">新規登録はこちら</a>
</body>
</html>
