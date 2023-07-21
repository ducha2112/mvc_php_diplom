<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?=$data['title']?>></title>
    <meta name="description" content="Главная страница ресурса">
    <link rel="icon" href="/public/img/owl.png" sizes="any">
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>
<header class="container">
    <nav class="navigate" >
        <div class="left" >
            <a class="link" href="/">
                <img src="/public/img/owl.png" alt="Сова автор: Freepik">
                <span>Уберем все <br> лишнее из ссылки!</span></a>
        </div>
        <div class="right" >
            <ul class="">
                <li >
                    <a class="nav link " aria-current="page" href="/">Главная</a>
                </li>
                <li >
                    <a class="nav link" href="/home/about">Про нас</a>
                </li>

                <li >
                    <a href="/contacts">Контакты</a>
                </li>

                <li >
                    <?php  $login = isset($_COOKIE['login']) ? $_COOKIE['login'] : ''; ?>
                    <?php if($login):?>

                        <a href="/user/" class="">Личный кабинет</a>

                    <?php else:?>

                        <a href="/user/login" class="">Войти</a>

                    <?php endif;?>
                </li>
            </ul>
        </div>
    </nav>

</header>
