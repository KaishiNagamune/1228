<?php

session_start();

$dsn = 'mysql:dbname=tb210541db;host=localhost';
$user = 'tb-210541';
$password = '8Cx5W9TzNV';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));

$errorMessage = "";

// ログインボタンが押された場合
if (isset($_POST["login"])) {
    // 1. ユーザIDの入力チェック
    if (empty($_POST["userid"])) {  // emptyは値が空のとき
        $errorMessage = 'ユーザーIDが未入力です。';
    } else if (empty($_POST["password"])) {
        $errorMessage = 'パスワードが未入力です。';
    }
}

if (!empty($_POST["userid"]) && !empty($_POST["password"])) {
    // 入力したユーザIDを格納
    $userid = $_POST["userid"];
    $password = $_POST["password"];

    $sql = 'SELECT * FROM bankinfo1';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach ($result as $row){
      if($userid==intval($row['id'])&&strcmp($password,$row['password'])==0){    
        $_SESSION["id"]=$row['id'];
        $_SESSION["NAME"] = $row['name'];
        $_SESSION["money"] = $row['money'];
        header("Location: Main.php");  // メイン画面へ遷移
        exit();  // 処理終了
      }elseif($userid==intval($row['id'])&&strcmp($password,$row['password'])!=0){
        echo "パスワードが違います<br>";
      }  
  }


    // 2. ユーザIDとパスワードが入力されていたら認証する
    //$dsn = sprintf('mysql: host=%s; dbname=%s; charset=utf8', $db['host'], $db['dbname']);

    // 3. エラー処理
    /*
    try {
        
        $stmt = $pdo->prepare('SELECT * FROM bankinfo WHERE name = ?');
        $stmt->execute(array($userid));

        $password = $_POST["password"];

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            if($password===$row['password']){
            //if (password_verify($password, $row['password'])) {
                //session_regenerate_id(true);

                // 入力したIDのユーザー名を取得
                $id = $row['id'];
                $sql = "SELECT * FROM userData WHERE id = $id";  //入力したIDからユーザー名を取得
                $stmt = $pdo->query($sql);
                foreach ($stmt as $row) {
                    $row['name'];  // ユーザー名
                }
                $_SESSION["NAME"] = $row['name'];
                header("Location: Main.php");  // メイン画面へ遷移
                exit();  // 処理終了
            } else {
                // 認証失敗
                $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
            }
        } else {
            // 4. 認証成功なら、セッションIDを新規に発行する
            // 該当データなし
            $errorMessage = 'ユーザーIDあるいはパスワードに誤りがあります。';
        }
    } catch (PDOException $e) {
        $errorMessage = 'データベースエラー';
        //$errorMessage = $sql;
        // $e->getMessage() でエラー内容を参照可能（デバッグ時のみ表示）
        // echo $e->getMessage();
    }
    */
}


?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
        <h1>ログイン画面</h1>
        <form id="loginForm" name="loginForm" action="" method="POST">
                <legend>ログインフォーム</legend>
                
                <div><font color="#ff0000"><?php echo htmlspecialchars($errorMessage, ENT_QUOTES); ?></font></div>

                <label for="userid">ユーザーID</label><input type="text" id="userid" name="userid" placeholder="ユーザーIDを入力" value="<?php if (!empty($_POST["userid"])) {echo htmlspecialchars($_POST["userid"], ENT_QUOTES);} ?>">
                <br>
                <label for="password">パスワード</label><input type="password" id="password" name="password" value="" placeholder="パスワードを入力">
                <br>
                <input type="submit" id="login" name="login" value="ログイン">
        </form>
        <br>
        <form action="mission_6-2_mail.php">     
                <legend>メール認証はこちら</legend>
                <input type="submit" value="メール認証">
        </form>
    </body>
</html>