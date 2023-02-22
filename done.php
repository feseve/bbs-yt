<?php
    //dotenv読み込み
    require "dotenv.php";

    session_start();
    $f_nonce = $_REQUEST["f_nonce"];
    //CSRF対策
    if(isset($f_nonce) && $f_nonce == $_SESSION["nonce"]):
        echo "成功";
        unset($_SESSION["nonce"]);
    else:
        echo "失敗";
    endif;

    $f_username = $_POST["username"];
    $f_comment = $_POST["comment"];
    $f_postDate = date("Y-m-d H:i:s");

    //DB接続
    //mysql:host=localhost;もある
    try{
        $pdo = new PDO('mysql:host=127.0.0.1;dbname=bbs-yt', $_ENV['DB_USER'], $_ENV['DB_PASS']);
    } catch (PDOExeception $e){
        echo $e->getMessage();
    }

    //空欄がなければ保存
    if(!(empty($f_username) || empty($f_comment))):
        try{
            $stmt = $pdo->prepare("INSERT INTO `bbs-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
            $stmt->bindParam(':username', $f_username, PDO::PARAM_STR);
            $stmt->bindParam(':comment', $f_comment, PDO::PARAM_STR);
            $stmt->bindParam(':postDate', $f_postDate, PDO::PARAM_STR);

            $stmt->execute();        
        } catch (PDOExeception $e){
            echo $e->getMessage();
        }
    else:
        echo "登録できませんでした";
    endif;

    //DBの接続を閉じる
    $pdo = null;
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>完了ページ</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="index.php" method="get">
        <input type="submit" value="戻る">
    </form>
</body>
</html>