<?php 
    require_once '../dbconnect.php';

    class UserLogic{
        /**
         * ユーザーを登録する
         * @params array $userDate
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
    }
?>