<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ユーザー登録画面</title>
</head>
<body>
    <h2>ユーザー登録フォーム</h2>
    <form action="registar.php" method="post">
        <p>
            <label for="usrname">名前：</label>
            <input type="text" name="username">
        </p>
        <p>
            <label for="email">メールアドレス：</label>
            <input type="text" name="email">
        </p>
        <p>
            <label for="password">パスワード：</label>
            <input type="password" name="password">
        </p>
        <p>
            <label for="password_conf">パスワード確認：</label>
            <input type="password" name="password_conf">
        </p>
        <p>
            <input type="submit" value="登録">
        </p>
    </form>
</body>
</html>