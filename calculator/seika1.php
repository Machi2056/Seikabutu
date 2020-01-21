<?php
// 数字、または「.」が押されたら
if (isset($_POST['num'])) {
  if ($_POST['num1'] != '' && $_POST['pre_ope'] != '' && $_POST['num2'] == '') {
    $_POST['in'] = 0;
    num_set();
  } elseif ($_POST['equal'] === '=') {
    $num = $_POST['num'];
  } else {
    num_set();
  }
} else {
  $num = 0;
}

// 四則演算子が押されたら
if (isset($_POST['ope'])) {
  if ($_POST['num1'] !== '' && $_POST['pre_ope'] !== '' && $_POST['num2'] !== '' && $_POST['equal'] === '') {
    $ope = $_POST['ope'];
    switch ($_POST['pre_ope']) {
      case '+':
        $num = $_POST['num1'] + $_POST['num2'];
        $num1 = $_POST['num1'] + $_POST['num2'];
        break;
      case '-':
        $num = $_POST['num1'] - $_POST['num2'];
        $num1 = $_POST['num1'] - $_POST['num2'];
        break;
      case 'x':
        $num = $_POST['num1'] * $_POST['num2'];
        $num1 = $_POST['num1'] * $_POST['num2'];
        break;
      case '÷':
        $num = $_POST['num1'] / $_POST['num2'];
        $num1 = $_POST['num1'] / $_POST['num2'];
        break;
    }
  } else {
    $num = $_POST['in'];
    $num1 = $_POST['in'];
    $ope = $_POST['ope'];
  }
}

// =が押されたら
if (isset($_POST['='])) {
  if ($_POST['num1'] !== '' && $_POST['pre_ope'] !== '' && $_POST['num2'] !== '') {
    $ope = $_POST['pre_ope'];
    $num2 = $_POST['num2'];
    $equal = $_POST['='];
    switch ($_POST['pre_ope']) {
      case '+':
        $num = $_POST['num1'] + $_POST['num2'];
        $num1 = $_POST['num1'] + $_POST['num2'];
        break;
      case '-':
        $num = $_POST['num1'] - $_POST['num2'];
        $num1 = $_POST['num1'] - $_POST['num2'];
        break;
      case 'x':
        $num = $_POST['num1'] * $_POST['num2'];
        $num1 = $_POST['num1'] * $_POST['num2'];
        break;
      case '÷':
        $num = $_POST['num1'] / $_POST['num2'];
        $num1 = $_POST['num1'] / $_POST['num2'];
        break;
    }
  } elseif ($_POST['num1'] !== '' && $_POST['pre_ope'] !== '' && $_POST['num2'] === '') {
    $num2 = $_POST['num1'];
    $ope = $_POST['pre_ope'];
    $equal = $_POST['='];
    switch ($_POST['pre_ope']) {
      case '+':
        $num = $_POST['num1'] + $_POST['num1'];
        $num1 = $_POST['num1'] + $_POST['num1'];
        break;
      case '-':
        $num = $_POST['num1'] - $_POST['num1'];
        $num1 = $_POST['num1'] - $_POST['num1'];
        break;
      case 'x':
        $num = $_POST['num1'] * $_POST['num1'];
        $num1 = $_POST['num1'] * $_POST['num1'];
        break;
      case '÷':
        $num = $_POST['num1'] / $_POST['num1'];
        $num1 = $_POST['num1'] / $_POST['num1'];
        break;
    }
  } else {
    $num = $_POST['in'];
  }
}

// C  +/-  % が押されたら
if (isset($_POST['button'])) {
  switch ($_POST['button']) {
    case 'C':
      $num = 0;
      $_POST['in'] = '';
      $_POST['num1'] = '';
      $_POST['pre_ope'] = '';
      $_POST['num2'] = '';
      $_POST['equal'] = '';
      break;
    case '+/-':
      if (($_POST['num1'] !== '' && $_POST['pre_ope'] !== '') || ($_POST['num1'] === '' && $_POST['pre_ope'] === '')) {
        if ($_POST['in'] === '-0') {
          $num = '0';
          $num2 = '0';
          $num1 = $_POST['num1'];
          $ope = $_POST['pre_ope'];
        } else {
          $num = '-0';
          $num2 = '-0';
          $num1 = $_POST['num1'];
          $ope = $_POST['pre_ope'];
        }
      } else {
        $num = -$_POST['in'];
        $num2 = -$_POST['in'];
        $num1 = $_POST['num1'];
        $ope = $_POST['pre_ope'];
      }
      break;
    case '%':
      if ($_POST['num1'] === '' || $_POST['equal'] === '=') {
        $num = $_POST['in'] / 100;
      } elseif ($_POST['num2'] === '') {
        $num = $_POST['in'];
        $num1 = $_POST['num1'];
        $ope = $_POST['pre_ope'];
      } else {
        $num = $_POST['in'];
        $num2 = $_POST['in'];
        $num1 = $_POST['num1'];
        $ope = $_POST['pre_ope'];
      }
      break;
  }
}

function num_set() {
  global $num, $num1, $num2, $ope;
  // . が押されたら
  if (preg_match('/\./', $_POST['num'])) {
    if (preg_match('/\./', $_POST['in'])) {
      $num = $_POST['in'];
      $num2 = $_POST['in'];
      $num1 = $_POST['num1'];
      $ope = $_POST['pre_ope'];
    } elseif ($_POST['in'] == 0) {
      $num = '0.';
      $num2 = '0.';
      $num1 = $_POST['num1'];
      $ope = $_POST['pre_ope'];
    } else {
      $num = $_POST['in'];
      $num2 = $_POST['in'];
      $num .= $_POST['num'];
      $num2 .= $_POST['num'];
      $num1 = $_POST['num1'];
      $ope = $_POST['pre_ope'];
    }
  } else {
    if (preg_match('/(0\.)|[1-9]/', $_POST['in'])) {
      $num = $_POST['in'];
      $num2 = $_POST['in'];
      $num .= $_POST['num'];
      $num2 .= $_POST['num'];
      $num1 = $_POST['num1'];
      $ope = $_POST['pre_ope'];
    } elseif ($_POST['in'] === '-0') {
      $num = '-';
      $num2 = '-';
      $num .= $_POST['num'];
      $num2 .= $_POST['num'];
      $num1 = $_POST['num1'];
      $ope = $_POST['pre_ope'];
    } else {
      $num = '';
      $num = $_POST['num'];
      $num2 = $_POST['num'];
      $num1 = $_POST['num1'];
      $ope = $_POST['pre_ope'];
    }
  }
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <title>電卓</title>
  <meta charset="utf-8">
</head>
<body>
  <?php echo $num; ?>
  <form action="" method="post">
    <input type="hidden" name="in" value="<?php echo $num; ?>" placeholder="in" readonly="readonly">
    <input type="hidden" name="num1" value="<?php echo $num1; ?>" placeholder="num1" readonly="readonly">
    <input type="hidden" name="pre_ope" value="<?php echo $ope; ?>" placeholder="pre_ope" readonly="readonly">
    <input type="hidden" name="num2" value="<?php echo $num2; ?>" placeholder="num2" readonly="readonly">
    <input type="hidden" name="equal" value="<?php echo $equal; ?>" placeholder="=" readonly="readonly">
    <table>
      <tr>
        <td><input type="submit" name="button" value="C"></td>
        <td><input type="submit" name="button" value="+/-"></td>
        <td><input type="submit" name="button" value="%"></td>
        <td><input type="submit" name="ope" value="÷"></td>
      </tr>
      <tr>
        <td><input type="submit" name="num" value="7"></td>
        <td><input type="submit" name="num" value="8"></td>
        <td><input type="submit" name="num" value="9"></td>
        <td><input type="submit" name="ope" value="x"></td>
      </tr>
      <tr>
        <td><input type="submit" name="num" value="4"></td>
        <td><input type="submit" name="num" value="5"></td>
        <td><input type="submit" name="num" value="6"></td>
        <td><input type="submit" name="ope" value="-"></td>
      </tr>
      <tr>
        <td><input type="submit" name="num" value="1"></td>
        <td><input type="submit" name="num" value="2"></td>
        <td><input type="submit" name="num" value="3"></td>
        <td><input type="submit" name="ope" value="+"></td>
      </tr>
      <tr>
        <td colspan="2"><input type="submit" name="num" value="0"></td>
        <td><input type="submit" name="num" value="."></td>
        <td><input type="submit" name="=" value="="></td>
      </tr>
    </table>
  </form>
</body>
</html>
