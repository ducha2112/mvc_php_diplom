
<?php require 'app/views/components/header.php' ?>

<div class="container main">

    <h1><?=$data['title']?></h1>
   <p>Привет, <?=$_COOKIE['login']?></p>

    <form action="/user/" method="post" class="form">
        <input type="hidden" name="exit_btn">
        <button type="submit" >Выйти</button>
    </form>


</div>
<?php require 'app/views/components/footer.php' ?>


</body>
</html>

