<?php
    session_start();
    require_once '../classes/UserLogic.php';
    require_once '../functions.php';
    
    //ログインしているか判定
    $result = UserLogic::checkLogin();

    if(!$result){
        $_SESSION['login_err'] = "ユーザ登録を完了して、ログインしてください";
        header('Location: signup_form.php');
        return;
    }

    $login_user = $_SESSION['login_user'];

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>マイページ</title>
    </head>
    <body>
        <h2>マイページ</h2>
        <p>ログインユーザ：<?php echo h($login_user['name']); ?></p>
        <p>メールアドレス：<?php echo h($login_user['email']); ?></p>
        <a href="./login.php">ログアウト</a>
    </body>
</html>