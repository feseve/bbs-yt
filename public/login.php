<?php
    require_once '../classes/UserLogic.php';
    session_start();

    //エラーメッセージ
    $err = [];

    //バリデーション
    //postで受け取った値を表示
    if(!$email = filter_input(INPUT_POST, 'email')){
        $err['email'] = "emailを入力してください";
    }
    if(!$password = filter_input(INPUT_POST, 'password')){
        $err['password'] = "パスワードを記入してください";
    }

    if(count($err) > 0){
        //エラーがあった場合
        $_SESSION = $err;
        header('Location: login_form.php');
        return;
    }
    //ログイン成功時
    $result = UserLogic::login($email, $password);
    if(!$result){
        //ログイン失敗時
        header('Location: login_form.php');
        return;
    }

?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ログイン完了</title>
    </head>
    <body>
        <h2>ログイン完了</h2>
        <p>ログインしました!</p>
        <a href="./mypage.php">マイページへ</a>
    </body>
</html>