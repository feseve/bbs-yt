<?php
    session_start();
    require_once '../classes/UserLogic.php';

    //エラーメッセージ
    $err = [];

    $token = filter_input(INPUT_POST, 'csrf_token');
    //トークンがないもしくは一致しない場合は中止
    if(!isset($_SESSION['csrf_token']) || $token !== $_SESSION['csrf_token']){
        exit('不正なアクセスです');
    }
    //csrfと二重送信の対策
    unset($_SESSION['csrf_token']);
    
    //バリデーション
    //postで受け取った値を表示
    if(!$username = filter_input(INPUT_POST, 'username')){
        $err['username'] = "ユーザー名を入力してください";
    }
    if(!$email = filter_input(INPUT_POST, 'email')){
        $err['email'] = "emailを入力してください";
    }
    $password = filter_input(INPUT_POST, 'password');
    //正規表現
    if (!preg_match('/\A[a-z\d]{8,100}+\z/i', $password)) {
        $err['password'] = 'パスワードは英数字8文字以上100文字以下にしてください。';
    }
    $password_conf = filter_input(INPUT_POST, 'password_conf');
    if($password !== $password_conf){
        $err['password_conf'] = "確認用のパスワードと異なっています。";
    }

    if(count($err) > 0){
        //エラーがあった場合
        $_SESSION = $err;
        header('Location: signup_form.php');
        return;
    } else {
        //ユーザーを登録
        $hasCreated = UserLogic::createUser($_POST);
        if(!$hasCreated){
            $err[] = "登録に失敗しました。";
        }
    }
?>

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>ユーザー登録完了画面</title>
    </head>
    <body>
        <?php if (count($err) > 0): ?>
            <?php foreach($err as $e): ?>
                <p><?php echo $e ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <p>ユーザー登録が完了しました</p>
        <?php endif; ?>
        <a href="./signup_form.php">戻る</a>
    </body>
</html>