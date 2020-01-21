<?php

session_start();

class Post {
  public $name = '';
  public $old = '';
  public $color = '';
  public $colors = [];
  public $err = '';
  public $oldErr = '';

  public function nameCheck() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && preg_match('/.+/', $_POST['name'])) {
      $this->name = $_POST['name'];
      $_SESSION['name'] = $this->name;
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['name'] === '') {
      $this->err = '必須項目です';
    }
  }

  public function oldCheck() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && preg_match('/^[0-9]{1,}$/', $_POST['old'])) {
      $this->old = $_POST['old'];
      $_SESSION['old'] = $this->old;
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['old'] === '') {
      $this->err = '必須項目です';
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && !preg_match('/^[0-9]{1,}$/', $_POST['old'])) {
      $this->oldErr = '0以上の整数値を入力してください';
    }
  }

  public function colorCheck() {
    if (!empty($_POST['colors']) && $this->name !== '' && $this->old !== '') {
      foreach ($_POST['colors'] as $value) {
        if (!empty($this->color)) {
          $this->color .= ', ';
        }
        $this->color .= $value;
      }

      $_SESSION['color'] = '';

      if ($_SESSION['name'] !== '' && $_SESSION['old'] !== '') {
        $_SESSION['color'] = $this->color;
      }
    }
  }

  public function kanryouCheck() {
    if ($this->name !== '' && $this->old !== '') {
      header("Location: http://192.168.33.10:8000/a.kanryou.php");
      exit;
    }
  }

}
