<?php 
    require_once '../dbconnect.php';

    class UserLogic{
        /**
         * ユーザーを登録する
         * @param array $userDate
         * @return bool $result
         */
        public static function createUser($userDate){
            $result = false;
            $sql = 'INSERT INTO users (name, email, password) VALUES (?, ?, ?)';

            //ユーザーデータを配列に入れる
            $arr = [];
            $arr[]  = $userDate['username'];
            $arr[]  = $userDate['email'];
            //ハッシュ化
            $arr[]  = password_hash($userDate['password'], PASSWORD_DEFAULT);

            try{
                $stmt = connect()->prepare($sql);
                $result = $stmt->execute($arr);
                return $result;
            } catch(\Exception $e){
                return $result;
            }
        }

        /**
         * ログイン処理
         * @param string $email
         * @param string $password
         * @return bool $result
         */
        public static function login($email, $password){
            //結果
            $result = false;
            //ユーザをemailから検索して取得
            $user = self::getUserByEmail($email);

            if(!$user){
                $_SESSION['msg'] = "emailが一致しません";
                return $result;
            }

            //パスワードの照会
            if(password_verify($password, $user['password'])){
                //ログイン成功
                //sessionIDを変更　セッションハイジャック対策
                session_regenerate_id(true);
                $_SESSION['login_user'] = $user;
                $result = true;
                return $result;
            }

            $_SESSION['msg'] = "passwordが一致しません";
            return $result;
        }

        /**
         * emailからユーザを取得
         * @param string $email
         * @return array|bool $user|false
         */
        public static function getUserByEmail($email){
            //SQLの準備
            //SQLの実行
            $sql = 'SELECT * FROM users WHERE email = ?';

            //emailを配列に入れる
            $arr = [];
            $arr[]  = $email;

            try{
                $stmt = connect()->prepare($sql);
                $result = $stmt->execute($arr);
                //SQLの結果を返す
                $user = $stmt->fetch();
                return $user;
            } catch(\Exception $e){
                return false;
            }
        }

        /**
         * ログインチェック
         * @param void
         * @return bool $result
         */
        public static function checkLogin(){
            $result = false;

            //セッションにユーザがあるかを確認
            if(isset($_SESSION['login_user']) && $_SESSION['login_user']['id'] > 0){
                return $result = true;
            } 

            return $result;
        }
    }
?>