<?php
function h($s) {
  return htmlspecialchars($s, ENT_QUOTES, 'UTF-8');
}

function user_check($name) {
  if ((strlen(trim($name)) > 0 && strlen(trim($name)) < 100)
    && preg_match('/\A[0-9A-Za-z]+\z/', $name)) { // 長すぎない半角英数字のユーザー名が入力されていたら
        return true;
    }
}

function password_check($pass) {
  if((strlen(trim($pass)) > 0  && strlen(trim($pass)) >= 8)
    && preg_match('/\A[0-9A-Za-z]+\z/', $pass)) { // 短すぎない半角英数字のパスワードが入力されていたら
    return true;
  }
}
