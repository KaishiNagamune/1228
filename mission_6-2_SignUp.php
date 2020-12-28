<?php

session_start();

$dsn = 'mysql:dbname=tb210541db;host=localhost';
$user = 'tb-210541';
$password = '8Cx5W9TzNV';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$sql = "CREATE TABLE IF NOT EXISTS bankinfo1"
	." ("
	. "id INT AUTO_INCREMENT PRIMARY KEY,"
  . "name char(32),"
  . "money INT default 0,"
  . "password char(30)"
  .");";
    
$stmt = $pdo->query($sql);

$errorMessage = "";
$signUpMessage = "";

if (isset($_POST["signUp"])) {
  // 1. ユーザIDの入力チェック
  if (empty($_POST["username"])) {  // 値が空のとき
      $errorMessage = 'ユーザーIDが未入力です。';
  } else if (empty($_POST["password"])) {
      $errorMessage = 'パスワードが未入力です。';
  } else if (empty($_POST["password2"])) {
      $errorMessage = 'パスワードが未入力です。';
  }


  if (!empty($_POST["username"]) && !empty($_POST["password"]) && !empty($_POST["password2"]) && $_POST["password"] === $_POST["password2"]) {
    // 入力したユーザIDとパスワードを格納
    
    // 2. ユーザIDとパスワードが入力されていたら認証する
    //$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

    // 3. エラー処理
    //try {
        
        $sql = $pdo -> prepare("INSERT INTO bankinfo1 (name, password) VALUES (:name, :password)");

        $sql -> bindParam(':name', $username, PDO::PARAM_STR);
        
        $sql -> bindParam(':password', $password, PDO::PARAM_STR);

        $username = $_POST["username"];
      
        $password = $_POST["password"];
    

        $sql -> execute();
      /*
        //$stmt->execute(array($username, password_hash($password, PASSWORD_DEFAULT)));  // パスワードのハッシュ化を行う（今回は文字列のみなのでbindValue(変数の内容が変わらない)を使用せず、直接excuteに渡しても問題ない）
        $stmt->execute(array($username, $password));
      */
        $userid = $pdo->lastinsertid();  // 登録した(DB側でauto_incrementした)IDを$useridに入れる
      
        $signUpMessage = '登録が完了しました。あなたの登録IDは '. $userid. ' です。パスワードは '. $password. ' です。';  // ログイン時に使用するIDとパスワード
      /*
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
        // echo $e->getMessage();
    }
    */
  } else if($_POST["password"] != $_POST["password2"]) {
    $errorMessage = 'パスワードに誤りがあります。';
  }
}

?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>新規登録</title>
    </head>
    <body>
        <h1>新規登録画面</h1>
        <form id="loginForm" name="loginForm" action="mission_6-2_SignUp.php" method="POST">
            
                <legend>新規登録フォーム</legend>

                <!--メッセージの表示-->
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>
                <div><font color="#0000ff"><?php echo htmlspecialchars($signUpMessage, ENT_QUOTES); ?></font></div>

                <label for="username">ユーザー名</label><input type="text" id="username" name="username" placeholder="ユーザー名を入力" value="<?php if (!empty($_POST["username"])) {echo htmlspecialchars($_POST["username"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <label for="password2">パスワード(確認用)</label><input type="password" id="password2" name="password2" value="" placeholder="再度パスワードを入力">
                <br>
                <input type="submit" id="signUp" name="signUp" value="新規登録">
          
        </form>
        <br>

        <form action="mission_6-2_Login.php">
            <input type="submit" value="ログインページへ">
        </form>


    </body>
</html>