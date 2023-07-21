<?php

    class Home extends Controller {

        public function index() {
            $data = [];
            $data['title'] = 'Главная страница';
            $user = $this->model('UserModel');

            if(isset($_COOKIE['login'])) { # если пользователь аторизован
                $user = $user->getUser($_COOKIE['login']);
                $user_id = $user['id']; # получаем id пользователя ссылки
                $link = $this->model('LinksModel');

                if (isset($_POST['del_link'])) $link->delLink($_POST['del_link']);

                if (isset($_POST['long_link'])) { # если идут данные с формы ссылок
                    $link->setData($_POST['long_link'], $_POST['short_link'], $user_id);
                    $is_link_in_db = $link->checkLinks($_POST['short_link']);

                     // проверяем наличие короткой ссылки в БД
                        if($is_link_in_db == 1) $data['mess'] = 'Такая короткая ссылка уже существует! Придумайте другую';
                        else
                           $link->writeLinksToDB();
            }
                    $data['res'] = $link->getLinks($user_id);

                }

            else{
                if (isset($_POST['login'])) { # если идут данные с формы регистрации пользователя

                    $user->setUserData($_POST['email'], $_POST['login'], $_POST['pass']);
                    $data['email'] = $_POST['email'];
                    $data['login'] = $_POST['login'];

                    $isValid = $user->checkData();

                    if ($isValid == 'Done') {
                        $user->addUser();
                        $data['email'] = '';
                        $data['login'] = '';
                    } else $data['mess'] = $isValid;
                }
            }

            $this->view('home/index',$data);
        }
        public function about() {
            $data = [];
            $data['title'] = 'О компании';
            $this->view('home/about',$data);
        }
    }
