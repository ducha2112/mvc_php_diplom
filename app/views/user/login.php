
<?php require 'app/views/components/header.php' ?>

<div class="container main">
    <h1>Авторизуйтесь</h1>

    <?php
        $login = isset($_POST['login']) ? $_POST['login'] : '';
        $message = isset($data['mess']) ? $data['mess'] : '';
    ?>

    <form action="/user/login" method="post" class="register form">
        <input type="text" name="login" placeholder="Введите логин" value="<?=$login?>">
        <input type="password" name="pass" placeholder="Введите пароль" >
        <p><?=$message?></p>
        <button>Войти</button>
    </form>


</div>
<?php require 'app/views/components/footer.php' ?>


</body>
</html>

