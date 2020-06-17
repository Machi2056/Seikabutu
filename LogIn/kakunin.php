<?php

// 後に実装予定
// 合わせて新規登録画面でパスワードを２回入力する仕様に変更

// require('config.php');
// require('functions.php');
//
// $error_msg = "";
// $name_error_msg = "";
// $password_error_msg = "";
// $form_data = "";
// $name = "";
// $pass = "";
//
// if (isset($_POST['sub'])) { // サブミットボタンが押されたら
//   $name = $_POST['name'];
//   $pass = $_POST['password'];
//   if (user_check($name) === true && password_check($pass) === true) { // ユーザー名とパスワードが正しく入力されていたら
//     try {
//       $db = new PDO(DSN, DB_USERNAME, DB_PASSWORD);
//       $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//
//       $stmt = $db->prepare("SELECT COUNT(username) FROM users WHERE username = :name");
//       $stmt->bindParam(':name', $name);
//       $stmt->execute();
//       $user = $stmt->fetch(PDO::FETCH_ASSOC);
//
//       if (!$user) { // ユーザーが登録されていなければデータベースに保存する
//         $hash = password_hash($pass, PASSWORD_DEFAULT);
//
//         $stmt = $db->prepare("INSERT INTO users (user, password) VALUES (:name, :pass)");
//         $stmt->bindParam(':name', $name);
//         $stmt->bindParam(':pass', $pass);
//         $stmt->execute();
//
//         header('Location: login.php');
//       } else {
//         $error_msg = "このユーザー名は既に使用されています。";
//       }
//
//     } catch (PDOException $e) {
//       echo $e->getMessage();
//       exit;
//     }
//   } else {
//     if (strlen(trim($_POST['name'])) == 0) { // 空の時
//       $name_error_msg = "ユーザー名を入力してください。";
//     } elseif (strlen(trim($name)) > 100) { // 長すぎる時
//       $name_error_msg = "ユーザー名が長すぎます。";
//     } elseif (!preg_match('/\A[0-9A-Za-z]+\z/', $name)) {
//       $name_error_msg = "半角英数字で入力してください。";
//     } else {
//       $form_data = $name;
//     }
//
//     if (strlen(trim($_POST['password'])) == 0) { // 空の時
//       $password_error_msg = "パスワードを入力してください。";
//     } elseif (strlen(trim($_POST['password'])) < 8) {
//      $password_error_msg = "パスワードが短すぎます。";
//     } else {
//       $password_error_msg = "半角英数字で入力してください。";
//     }
//   }
// }
