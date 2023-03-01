<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ログイン画面</title>
</head>
<body>
    <h2>ログインフォーム</h2>
    <form action="registar.php" method="post">
        <p>
            <label for="email">メールアドレス：</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="password">パスワード：</label>
            <input type="password" name="password">
        </p>
        <p>
            <input type="submit" value="ログイン">
        </p>
    </form>
    <a href="signup_form.php">新規登録はコチラ</a>
</body>
</html>