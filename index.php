<?php
    //dotenv読み込み
    require './vendor/autoload.php';

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $comment_array = array();

    if(!empty($_POST["submitButton"])){
        echo $_POST["username"];
        echo $_POST["comment"]; 
    }

    //DB接続
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=bbs-yt', $_ENV["DB_USER"], $_ENV["DB_PASS"]);
    } catch(PDOEeception $e){
        echo $e->getMessage();
    }

    //DBから情報取得
    $sql = "SELECT * FROM `bbs-table`;";
    $comment_array = $pdo->query($sql);

    //DBの接続を閉じる
    $pdo = null;
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHP掲示板</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <h1 class="title">掲示板アプリ</h1>
        <hr>
        <div class="boardWrapper">
            <section>
                <?php foreach($comment_array as $comment): ?>
                    <article>
                        <div class="wrapper">
                            <div class="nameArea">
                                <span>名前：</span>
                                <p class="username"><?php echo $comment["username"]; ?></p>
                                <time><?php echo $comment["postDate"]; ?></time>
                            </div>
                            <p class="comment"><?php echo $comment["comment"]; ?></p></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
            <form action="" class="formWrapper" method="post">
                <div>
                    <input type="submit" value="書き込む" name="submitButton">
                    <label for="">名前</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <textarea name="comment" class="commentTextArea"></textarea>
                </div>
            </form>
        </div>
    </body>
</html>