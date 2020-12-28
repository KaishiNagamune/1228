<?php
session_start();



// ログイン状態チェック
if (!isset($_SESSION["NAME"])) {
    header("Location: Logout.php");
    exit;
}
$dsn = 'mysql:dbname=tb210541db;host=localhost';
$user = 'tb-210541';
$password = '8Cx5W9TzNV';
$pdo = new PDO($dsn, $user, $password, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING));



if( !empty($_POST["outmoney"]) ){

    $id=$_SESSION["id"];
    $money=intval($_POST["outmoney"]);

    $sql = 'SELECT * FROM bankinfo1';
    $stmt = $pdo->query($sql);
    $result = $stmt->fetchAll();
    foreach ($result as $row){
      if( $id==intval($row['id']) ){
        if($row['money']-$money >= 0){
            $money=$row['money']-$money;
            $sql = 'update bankinfo1 set money=:money where id=:id';
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':money', $money, PDO::PARAM_STR);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            echo "出金が完了しました！残高は".$money."円です";        
            $_SESSION["money"]=$money;

        }else{
            echo "残高が足りません！残高は".$row['money']."円です";
        }
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
        <h1>お引き出し</h1>
        <form action="mission_6-2_OutMoney.php" method="POST">
                <legend>お引き出し</legend>

                <input type="text" name="outmoney" placeholder="金額を入力" value="">
                <br>
              
                <input type="submit" value="出金">
        </form>
        <br>
        
    </body>
</html>