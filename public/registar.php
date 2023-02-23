<?php

    //エラーメッセージ
    $err = [];

    //バリデーション
    //postで受け取った値を表示
    if(!$username = filter_input(INPUT_POST, 'username')){

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
    <p>ユーザー登録が完了しました</p>
    <a href="./signup_form.php">戻る</a>
</body>
</html>