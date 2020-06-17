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
  $pass2 = $_POST['password2'];
  if (user_check($name) === true &&
                            password_check($pass) === true &&
                            trim($pass) === trim($pass2)) { // ユーザー名とパスワードが正しく入力されていたら
    try {// データベースに接続
      $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
      $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $stmt = $db->prepare("SELECT COUNT(username) FROM users WHERE username = :name");// 登録ユーザー名が既に登録されていないかを確認
      $stmt->bindParam(':name', $name);
      $stmt->execute();
      $user = $stmt->fetch(PDO::FETCH_ASSOC);

      if (!in_array(1, $user)) { // 既にユーザーが登録されていなければデータベースに保存する
        $hash = password_hash($pass, PASSWORD_DEFAULT);// パスワードのハッシュ化

        $stmt = $db->prepare("INSERT INTO users (username, password) VALUES (:name, :hash)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':hash', $hash);
        $stmt->execute();

        header('Location: kanryou.php');
      } else {// ユーザー名がデータベースに既に存在していたらエラーを表示
        $error_msg = "このユーザー名は既に使用されています。";
        $form_data = $name;// フォームに値を保持
      }

    } catch (PDOException $e) {
      echo $e->getMessage();
      exit;
    }
  } else {// ユーザー名またはパスワードに不備があったらエラーを表示
    if (strlen(trim($name)) == 0) { // ユーザー名が空の時
      $name_error_msg = "ユーザー名を入力してください。";
    } elseif (strlen(trim($name)) > 100) { // ユーザー名が長すぎる時
      $name_error_msg = "ユーザー名が長すぎます。";
      $form_data = $name;
    } elseif (!preg_match('/\A[0-9A-Za-z]+\z/', $name)) {// ユーザー名が半角英数字でない時
      $name_error_msg = "半角英数字で入力してください。";
      $form_data = $name;
    } else {
      $form_data = $name;
    }

    if (strlen(trim($pass)) == 0) { // パスワードが空の時
      $password_error_msg = "パスワードを入力してください。";
    } elseif (strlen(trim($pass)) < 8) {// パスワードが8文字以下の時
      $password_error_msg = "パスワードが短すぎます。";
    } elseif (!preg_match('/\A[0-9A-Za-z]+\z/', $pass)) {// パスワードが半角英数字でない時
      $password_error_msg = "半角英数字で入力してください。";
    } elseif (trim($pass) !== trim($pass2)) {
      $password_error_msg = "パスワード入力に誤りがあります。";
    }
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>新規登録</title>
</head>
<body>
  <h1>新規登録</h1>
  <p style="color:red;"><?php echo h($error_msg) ?></p>
  <form action="" method="POST">
    ＊ユーザー名とパスワードを半角英数字で入力してください。<br>
    <input type="text" name="name" value="<?php echo h($form_data); ?>" placeholder="ユーザー名を入力">
    <p style="color:red;"><?php echo h($name_error_msg); ?></p>
    <br>
    ＊パスワードは8文字以上入力してください。
    <br>
    <input type="password" name="password" placeholder="パスワードを入力">
    <p style="color:red;"><?php echo h($password_error_msg); ?></p>
    <br>
    <input type="password" name="password2" placeholder="パスワードを再度入力">
    <br>
    <input type="submit" name="sub" value="登録する">
  </form>
  <a href="login.php">登録済みの方はこちら</a>
</body>
</html>
