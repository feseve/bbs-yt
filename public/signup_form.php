<?php 

    require_once '../functions.php';

    session_start();
    $err = $_SESSION;

    //セッション切断
    $_SESSION = array();
    session_destroy();
?>

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
    <form action="registar.php" method="POST">
        <p>
            <label for="username">名前：</label>
            <input type="text" name="username">
            <?php if (isset($err['username'])): ?>
                <p><?php echo $err['username']; ?></p>
            <?php endif; ?>
        </p>
        <p>
            <label for="email">メールアドレス：</label>
            <input type="email" name="email">
            <?php if (isset($err['email'])): ?>
                <p><?php echo $err['email']; ?></p>
            <?php endif; ?>
        </p>
        <p>
            <label for="password">パスワード：</label>
            <input type="password" name="password">
            <?php if (isset($err['password'])): ?>
                <p><?php echo $err['password']; ?></p>
            <?php endif; ?>
        </p>
        <p>
            <label for="password_conf">パスワード確認：</label>
            <input type="password" name="password_conf">
            <?php if (isset($err['password_conf'])): ?>
                <p><?php echo $err['password_conf']; ?></p>
            <?php endif; ?>
        </p>
        <input type="hidden" name="csrf_token" value="<?php echo h(setToken());?>">
        <p>
            <input type="submit" value="登録">
        </p>
    </form>
</body>
</html>