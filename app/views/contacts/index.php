
<?php require 'app/views/components/header.php' ?>

<div class="container main">
    <h1>Обратная связь</h1>
    <?php  // проверки на определенность перемернных
        $name = isset($data['name']) ? $data['name'] : '';
        $email = isset($data['email']) ? $data['email'] : '';
        $age = isset($data['age']) ? $data['age'] : '';
        $message = isset($data['message']) ? $data['message'] : '';
    ?>


    <form action="/contacts" method="post" class="register form">
        <input type="text" name="name" placeholder="Введите имя" value="<?=$name?>">
        <input type="email" name="email" placeholder="Введите email" value="<?=$email?>">

        <input type="text" name="age" placeholder="Введите возраст" value="<?=$age?>">
        <textarea name="message"  cols="30" rows="10" placeholder="Введите само сообщение"><?=$message?></textarea>
        <?php if(isset($data['success'])):?>
            <p class="success"><?=$data['success']?></p>
        <?php elseif(isset($data['error'])):?>
            <p class="error"><?=$data['error']?></p>
        <?php endif;?>
        <button type="submit">Отправить</button>

    </form>


</div>
<?php require 'app/views/components/footer.php' ?>

</body>
</html>

