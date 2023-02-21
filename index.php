<?php
    //dotenv読み込み
    require './vendor/autoload.php';

    date_default_timezone_set("Asia/Tokyo");

    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    $comment_array = array();
    $error_messages = array(); 

    //DB接続
        //mysql:host=localhost;もある
        try{
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=bbs-yt', $_ENV['DB_USER'], $_ENV['DB_PASS']);
        } catch (PDOExeception $e){
            echo $e->getMessage();
        }

    //フォームを打ち込んだとき
    if(!empty($_POST["submitButton"])){

        //名前のテェック
        if(empty($_POST["username"])){
            $error_messages["username"] = "名前を入力してください";
            echo "名前を入力してください";
        }

        //コメントのテェック
        if(empty($_POST["comment"])){
            $error_messages["comment"] = "コメントを入力してください";
            echo "コメントを入力してください";
        }

        //エスケープ処理を書きたい

        if(empty($error_messages)){
            $postDate = date("Y-m-d H:i:s");

            try{
                $stmt = $pdo->prepare("INSERT INTO `bbs-table` (`username`, `comment`, `postDate`) VALUES (:username, :comment, :postDate)");
                $stmt->bindParam(':username', $_POST['username'], PDO::PARAM_STR);
                $stmt->bindParam(':comment', $_POST['comment'], PDO::PARAM_STR);
                $stmt->bindParam(':postDate', $postDate, PDO::PARAM_STR);
        
                $stmt->execute();        
            } catch (PDOExeception $e){
                echo $e->getMessage();
            }
        }
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