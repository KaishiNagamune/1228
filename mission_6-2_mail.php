<!doctype html>
<html>
    <head>
            <meta charset="UTF-8">
            <title>メール認証</title>
    </head>
    <body>
        <h1>メール認証</h1>
        <!--
            <form id="loginForm" name="loginForm" action="" method="POST">
            -->
            <legend>メール認証</legend>

            <form method="POST" action="phpmailer/send_test_1.php">
                <input type="text" name="adress" value="@" placeholder="メールアドレスを入力してください"><br>
                <input type="submit" value="送信">
            </form>   
          
        
        <br>

        <form action="Login.php">
            <input type="submit" value="ログインページへ">
        </form>


    </body>
</html>