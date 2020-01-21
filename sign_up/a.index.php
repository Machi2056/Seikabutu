<?php

session_start();
unset($_SESSION['name']);
unset($_SESSION['old']);
unset($_SESSION['color']);

require_once('a.class.php');

$post = new Post;
$post->nameCheck();
$post->oldCheck();
$post->colorCheck();
$post->kanryouCheck();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <title>お問い合わせ画面</title>
  <link rel="stylesheet" href="a.styles.css">
</head>
<body>
  <h1>お問い合わせ画面</h1>
  <p>お問い合わせ内容を入力してください</p>

  <script>
  function kakunin() {
    var select = confirm("問い合わせますか？\n「OK」で送信\n「キャンセル」で送信中止");
     return select;
  }
  </script>

  <form action="" method="post" onsubmit="return kakunin()">
    <p>
      (必須) 名前 <input type="text" name="name" value="<?php if ($post->name !== '') { echo $post->name; } ?>">
      <?php
        if ($_POST['name'] === '' && !empty($post->err)) {
          echo '<label class="err">' . $post->err . '</label>';
        }
      ?>
    </p>
    <p>
      (必須) 年齢 <input type="text" name="old"  value="<?php if ($post->old >= 0) { echo $post->old; } ?>">  歳
      <?php
        if (!empty($post->oldErr)) {
          echo '<label class="err">' . $post->oldErr . '</label>';
        } elseif ($_POST['old'] === '' && !empty($post->err)) {
          echo '<label class="err">' . $post->err . '</label>';
        }
      ?>
    </p>
    <p>好きな色を選んでください(未選択 or 複数選択 <span>可</span>)</p>
            <p class="likeColors">
              <label class="colors"><input type="checkbox" name="colors[]" value="赤"
                <?php
                  if (in_array('赤', $_POST['colors'])) {
                    echo "checked";
                  }
                ?>>赤</label>
              <label class="colors"><input type="checkbox" name="colors[]" value="緑"
                <?php
                  if (in_array('緑', $_POST['colors'])) {
                    echo "checked";
                  }
                ?>>緑</label>
              <label><input type="checkbox" name="colors[]" value="青"
                <?php
                  if (in_array('青', $_POST['colors'])) {
                    echo "checked";
                  }
                ?>>青</label>
              </p>
    <p><input type="submit" value="送信"></p>
  </form>
  </body>
</html>
