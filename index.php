<?php
    //php8以降は echo $_POST["username] だと Undefined array key エラーが出る
    echo filter_input(INPUT_POST, 'username');
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
                <article>
                    <div class="wrapper">
                        <div class="nameArea">
                            <span>名前：</span>
                            <p class="username">shincode</p>
                            <time>:2023/2/15</time>
                        </div>
                        <p class="comment">手書きコメントです。</p></p>
                    </div>
                </article>
            </section>
            <form action="" class="formWrapper" method="post">
                <div>
                    <input type="submit" value="書き込む">
                    <label for="">名前</label>
                    <input type="text" name="username">
                </div>
                <div>
                    <textarea name="" class="commentTextArea"></textarea>
                </div>
            </form>
        </div>
    </body>
</html>