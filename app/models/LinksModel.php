<?php
    require_once 'DB.php';

    class LinksModel {

        public $long_link;
        public $short_link;
        public $user_id;
        public $_db = null;

        public function __construct() {
            $this->_db = DB::getConnectToDB();
        }
        public function setData($long_link,$short_link,$user_id) { # установка данных из формы
            $this->long_link = $long_link;
            $this->short_link = $short_link;
            $this->user_id = $user_id;
        }
        public function writeLinksToDB() {  # запись ссылок
            $sql = 'INSERT INTO links(long_link,short_link,user_id) VALUES (:long_link,:short_link,:user_id)';
            $query = $this->_db->prepare($sql);
            $query->execute(['long_link'=>$this->long_link,'short_link'=>$this->short_link,'user_id'=>$this->user_id]);
        }
        public function getLinks($id) { # выборка ссылок по id пользователя
            $sql = "SELECT * FROM links WHERE `user_id` = '$id'";
            $res = $this->_db->query($sql);
            return $res->fetchAll(PDO::FETCH_ASSOC);
        }
        public function checkLinks($short_link) { # проверка на наличие в БД короткой ссылки
            $sql = "SELECT EXISTS (SELECT * FROM links WHERE `short_link` = '$short_link')";
            $res = $this->_db->query($sql);
            foreach ($res->fetch(PDO::FETCH_ASSOC) as $el) {
                if($el == 1) return 1;
                else return 0;
            }


        }

        public function delLink($id) {
            $sql = "DELETE FROM links WHERE id = '$id'";
            $res = $this->_db->query($sql);
            return $res->fetch(PDO::FETCH_ASSOC);
        }
    }