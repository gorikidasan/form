<?php
var_dump($_POST);

// 変数を定義
$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
$tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
$item = $_POST['item'];
$text = nl2br(htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8'));
$date = new DateTime();
date_default_timezone_set('Asia/Tokyo');
$date = $date->format('Y-m-d H:i:s');
// エラーメッセージ
$err_msg_name = "名前を入力してください。";
$err_msg_email = "メールアドレスを入力してください。";
$err_msg_text = "お問い合わせ文を入力してください。";

// 投稿がある場合は投稿されたデータをそうでなければ空白で定義する
// 定義しておかないとエラーになる
if (isset($_POST['tel']) === true ){
  $tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
}

$page_flag = 0;

if( !empty($_POST['btn']) ) {

	$page_flag = 1;
}

?>
<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
  <div class="container">
    <h1>お問い合わせフォーム</h1>
    <br><br><br><br><br><br>
    <h5><span class="span_lbl">入力画面</span> > 確認画面 > 完了画面</h5>
    <form class="form" action="check.php" id="contact-form" method="post">
      <table class="table table-bordered">
        <tr>
          <th>Name</th>
          <td>
            <input type="text" name="name" value="<?php echo $name; ?>" placeholder="例＞山田太郎">
            <!-- 空白があった場合 -->
            <?php if ($_POST['btn'] == true && $name == ""):?>
              <br><label class="err_msg"><?php echo $err_msg_name; ?></label>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th>Tel</th>
          <td><input type="text" name="tel" value="<?php echo $tel; ?>" placeholder="例＞0000000000"></td>
        </tr>
        <tr>
          <th>Mail</th>
          <td>
            <input type="text" name="email" size="40" value="<?php echo $email; ?>" placeholder="例＞yamadataro@example.com">
            <!-- 空白があった場合 -->
            <?php if ($_POST['btn'] == true && $email == ""):?>
              <br><label class="err_msg"><?php echo $err_msg_email; ?></label>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <th>☆</th>
          <td>
            <select name="item">
              <option value="">お問い合わせ項目を選択してください</option>
              <option value="ご質問・お問い合わせ">ご質問・お問い合わせ</option>
              <option value="ご意見・ご感想">ご意見・ご感想</option>
            </select>
          </td>
        </tr>
        <tr>
          <th>Contents</th>
          <td>
            <textarea name="text" rows="8" cols="80"><?php echo $text; ?></textarea>
            <!-- 空白があった場合 -->
            <?php if ($_POST['btn'] == true && $text == ""):?>
              <br><label class="err_msg"><?php echo $err_msg_text; ?></label>
            <?php endif; ?>
          </td>
        </tr>
      </table>
      <br>
      <div class="text-center">
        <input type="submit" class="btn-outline-secondary btn-lg" id="btn_ok" value="確認画面へ">
      </div>
    </form>
  </div>


  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
