<!DOCTYPE html>
<html lang="ja" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
  <meta http-equiv="refresh" content="10;URL=send.php">
  <title>お問い合わせフォーム</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="test.js"></script>
</head>
<body>
  <div class="container">
    <h1>お問い合わせフォーム</h1>
    <br><br><br><br><br><br>
    <h5>入力画面 > <span class="span_lbl">確認画面</span> > 完了画面</h5>
    <br><br>
    <div id="contents">
      <div class="row">
        <label id="label_smh" class="col-sm-2 control-label" for="name">Name：</label>
        <div class="col-sm-10"><?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'); ?></div>
      </div><br>
      <div class="row">
        <label id="label_smh" class="col-sm-2 control-label" for="tel">Tel：</label>
        <div class="col-sm-10"><?php echo htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8'); ?></div>
      </div><br>
      <div class="row">
        <label id="label_smh" class="col-sm-2 control-label" for="email">Email：</label>
        <div class="col-sm-10"><?php echo htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8'); ?></div>
      </div><br>
      <div class="row">
        <label id="label_smh" class="col-sm-2 control-label" for="item">問い合わせ項目：</label>
        <div class="col-sm-10"><?php echo $_POST['item']; ?></div>
      </div><br>
      <div class="row">
        <label id="label_smh" class="col-sm-2 control-label" for="text">Contents：</label>
        <div class="col-sm-10"><?php echo nl2br(htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8')); ?></div>
      </div><br>
    </div>
    <div class="text-center">
      <button type="button" class="btn-outline-secondary btn-lg" id="Send();" name="btn1" value="">送信する</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </body>
  </html>

  <?php
  var_dump($_POST);

  // 変数宣言
  $user = 'ootaren'; // DB接続時のユーザー名
  $password = '04060406'; // DB接続時のパスワード


  // 変数宣言
  $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
  $tel = htmlspecialchars($_POST['tel'], ENT_QUOTES, 'UTF-8');
  $email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
  $item = $_POST['item'];
  $text = nl2br(htmlspecialchars($_POST['text'], ENT_QUOTES, 'UTF-8'));
  $date = new DateTime();
  date_default_timezone_set('Asia/Tokyo');
  $date = $date->format('Y-m-d H:i:s');
  $err_msg = "";


  try {
    $dbh = new PDO('mysql:host=localhost;dbname=db1;charset=utf8', $user, $password);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
    if(isset($_POST['btn'])) {
      $sql = "INSERT INTO form (name, tel, email, item, text ,date) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(1, $name, PDO::PARAM_STR);
      $stmt->bindValue(2, $tel, PDO::PARAM_INT);
      $stmt->bindValue(3, $email, PDO::PARAM_STR);
      $stmt->bindValue(4, $item, PDO::PARAM_STR);
      $stmt->bindValue(5, $text, PDO::PARAM_STR);
      $stmt->bindValue(6, $date, PDO::PARAM_INT);
      $stmt->execute();
      $dbh = null;
    }
  } catch (Exception $e) {
    echo "DB接続エラー: "  . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "<br>";
    die();
  }
