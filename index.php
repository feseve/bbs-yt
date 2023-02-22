<!-- エスケープ処理 -->
<?php 
    function h($s) {
        return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
    }
?>

<?php
    //dotenv読み込み
    require_once "dotenv.php";

    $comment_array = array();

    //session開始
    session_start();
    $rand = str_shuffle("ABCDEFGHIGKLMNOPQRSTUVWXYZ");
    $_SESSION["nonce"] = $rand;

    //DB接続
        //mysql:host=localhost;もある
        try{
            $pdo = new PDO('mysql:host=127.0.0.1;dbname=bbs-yt', $_ENV['DB_USER'], $_ENV['DB_PASS']);
        } catch (PDOExeception $e){
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
                                <p class="username"><?php echo h($comment["username"]); ?></p>
                                <time><?php echo h($comment["postDate"]); ?></time>
                            </div>
                            <p class="comment"><?php echo h($comment["comment"]); ?></p></p>
                        </div>
                    </article>
                <?php endforeach; ?>
            </section>
            <form action="done.php" class="formWrapper" method="post">
                <div>
                    <input type="submit" value="書き込む" name="submitButton">
                    <input type="hidden" name="f_nonce" value="<?php echo $rand; ?>">
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