<?php


    class User extends Controller {
        public function index()  {
            $data = [];
            $data['title'] = 'Кабинет пользователя';
            if (isset($_POST['exit_btn'])) {
                $user = $this->model('UserModel');
                $user->outAuth();
            }
            $this->view('user/index',$data);

        }

        public function login() {
            $data = [];
            $data['title'] = 'Страница авторизации';
            if (isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $data['mess'] = $user->auth($_POST['login'], $_POST['pass']);

            }
            $this->view('user/login', $data);
        }
        public function out() {
            if (isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $user->outAuth();
            }
        }
    }