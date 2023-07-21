<?php
  require_once 'DB.php';

    class UserModel {
        public $email;
        public $login;
        public $pass;
        public $_db = null;

        public  function __construct() {
            $this->_db = DB::getConnectToDB();
        }


        public function setUserData($email,$login,$pass) {
                $this->email = $email;
                $this->login = $login;
                $this->pass = $pass;
            }

        public  function checkData() { # проверка данных регистрирующегося пользователя

            if(strlen($this->email) < 3) return 'Некорректный Email, вводите внимательнее';
            else if($this->checkUser($this->login) != 'No') return $this->checkUser($this->login);
            else if(strlen($this->login) < 3) return 'Логин очень короткий';
            else if(strlen($this->pass) < 3) return 'Пароль введен некорректно';
            else return 'Done';
        }

        public function checkUser($login) {  # проверка наличия пользователя в БД
            $sql = "SELECT EXISTS (SELECT * FROM users WHERE `login`= '$login' )";
            $res = $this->_db->query($sql);
            $result = $res->fetch(PDO::FETCH_ASSOC);
            if (!$result) return 'No';

            foreach ($result as $el){
               if($el == 1) return 'Такой логин уже существует';
               else return 'No';
            }



        }
        public function getUser($login) { # берем пользователя из БД по логину

            $res = $this->_db->query("SELECT * FROM users WHERE `login`= '$login'");
            return $res->fetch(PDO::FETCH_ASSOC);

        }

        public function addUser() { # добавляем пользователя в БД
            $sql = 'INSERT INTO users(email,login,pass) VALUES(:email,:login,:pass)';
            $query = $this->_db->prepare($sql);

            $pass = password_hash($this->pass,PASSWORD_DEFAULT);
            $query->execute(['email'=>$this->email,'login'=>$this->login,'pass'=>$pass]);

            $this->setAuth($this->login);

        }
        public function auth($login,$pass) {   # авторизуем пользователя

            $user = $this->getUser($login);

            if($user['login'] == '')
                return 'Пользовавателя с таким логином не существует';
            else if(password_verify($pass,$user['pass'])){
                $this->setAuth($login);
            }
            else
                return 'Пароли не совпадают';

        }
        public function setAuth($login) {  # собственно аторизация
            setcookie('login',$login, time() + 3600, '/');
            header('Location: /user/index');
        }
        public function outAuth() {  # выход из авторизации
            setcookie('login',$this->login, time() - 3600, '/');
            unset($_COOKIE['login']);
            header('Location: /user/login');
        }


}