<?php
session_start();



// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: mission_6-2_Logout.php");
    exit;
}
$dsn = 'mysql:dbname=tb210541db;host=localhost';
$user = 'tb-210541';
$password = '8Cx5W9TzNV';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



if( !empty($_POST["inmoney"]) ){

    $id=$_SESSION["id"];
    $money=intval($_POST["inmoney"]);

    $sql = 'SELECT * FROM bankinfo1';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach ($result as $row){
      if( $id==intval($row['id']) ){
        $money=$money+$row['money'];
        $sql = 'update bankinfo1 set money=:money where id=:id';
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':money', $money, PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        echo "入金が完了しました！残高は".$money."円です";
        $_SESSION["money"]=$money;
      }
    }
}

?>

<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>ログイン</title>
    </head>
    <body>
        <h1>お預入れ</h1>
        <form action="mission_6-2_InMoney.php" method="POST">
                <legend>お預入れ</legend>

                <input type="text" name="inmoney" placeholder="金額を入力" value="">
                <br>
              
                <input type="submit" value="入金">
        </form>
        <br>
        
    </body>
</html>