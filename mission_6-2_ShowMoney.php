<?php
session_start();



// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: mission_6-2_Logout.php");
    exit;
}

?>

<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>メイン</title>
    </head>
    <body>
        <h1>残高照会</h1>
        <!-- ユーザーIDにHTMLタグが含まれても良いようにエスケープする -->
        <?php echo htmlspecialchars($_SESSION["NAME"], ENT_QUOTES); ?>さんの残高は<?php echo ($_SESSION["money"]); ?>円です。 <!-- ユーザー名をechoで表示 -->

    <!--    
        <ul>
            <li><a href="mission_6-2_OutMoney.php">お引き出し</a></li>
        </ul>

        <ul>
            <li><a href="mission_6-2_InMoney.php">お預入れ</a></li>
        </ul>
-->
       
        <ul>
            <li><a href="Logout.php">ログアウト</a></li>
        </ul>
    </body>
</html>

