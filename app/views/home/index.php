
<?php require 'app/views/components/header.php' ?>

<div class="container main">
    <h1>Сократ.им</h1>

    <?php if(isset($_COOKIE['login'])): ?>
        <h3>Хотите сократить ссылку? Сечас мы это сделаем:</h3>
    <?php  // проверки на определенность перемернных
        $long_link = isset($_POST['long_link']) ? $_POST['long_link'] : '';
        $short_link = isset($_POST['short_link']) ? $_POST['short_link'] : '';
        $mess = isset($data['mess']) ? $data['mess'] : '';
        ?>
        <form action="/" method="post" class="register form">
            <input type="text" name="long_link" placeholder="Длинная ссылка" value="<?=$long_link?>">
            <input type="text" name="short_link" placeholder="Введите свою короткую ссылку" value="">
            <p class="message"><?=$mess?></p>
            <button type="submit">Сократить</button>
        </form>
         <?php if(isset($data['res'][0]['short_link'])): ?>
            <?php foreach ($data['res'] as $el):?>
                <div class="links">
                    <p><b>Ваша длинная ссылка: </b> <a href="<?=$el['long_link']?>"><?=$el['long_link']?></a> </p>
                    <p><b>Ваша короткая ссылка: </b> <a href="<?=$el['long_link']?>"><?=$el['short_link']?></a> </p>
                    <form action="/" method="post" class="form">
                        <input type="hidden" name="del_link" value="<?=$el['id']?>">
                        <button type="submit">Удалить  <i class="fa-solid fa-trash-can"></i></button>
                    </form>

                </div>
            <?php  endforeach;?>

         <?php endif; ?>
    <?php else: ?>
            <h4>Быстро сократим любую длинную ссылку для вашего <br>проекта </h4>

            <h4>Сократить ссылку легко</h4>
            <p>
                С помощью нашего бесплатного и универсального сервиса сокращения URL Вы можете сделать из длинной ссылки короткую, или просто - сократить или укоротить ссылку. Короткие ссылки удобно отсылать в сообщениях или комментариях на facebook, instagram, twitter, vk, whatsapp, telegram или любом другом сервисе или сайте.<br><b>Нужно только зарегистрироваться  и авторизоваться</b></p>
    <?php  // проверки на определенность перемернных

        $email = isset($data['email']) ? $data['email'] : '';
        $login = isset($data['login']) ? $data['login'] : '';
        $mess = isset($data['mess']) ? $data['mess'] : '';
    ?>

            <div class="arrow"></div>
            <form action="/" method="post" class="register form">
                <input type="email" name="email" placeholder="Введите email" value="<?= $email?>">
                <input type="text" name="login" placeholder="Введите login" value="<?=$login?>">
                <input type="password" name="pass" placeholder="Введите пароль" >
                <?php if (isset($data['mess'])):?>
                    <p class="message"><?=$mess?></p>
                 <?php endif;?>
                <button type="submit">Зарегистрироваться</button>
                <p>Уже есть аккаунт? <a href="/user/login">Тогда входите!</a></p>
            </form>

</div>
<?php endif; ?>
<?php require 'app/views/components/footer.php' ?>

<script src="/public/js/main.js'"></script>


</body>
</html>
