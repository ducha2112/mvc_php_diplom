<?php


    class DB {
        private static $_db = null;

        public static function getConnectToDB() {

            if(self::$_db == null)
                self::$_db = new  PDO('mysql:host=localhost;dbname=socratim_db','root','root');

            return self::$_db;

        }
        private function __construct() {}
        private function __clone() {}
        public function __wakeup() {}

    }