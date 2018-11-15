<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/Comment.php');
$comments = Comment::getComments();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Комментарии</title>
    <link rel="stylesheet" href="/assets/css/app.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
          integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="assets/js/ajax.js"></script>
</head>
<body>
<div class="col-md-9">
    <div class=""><a href="/admin/login.php">Войти</a></div>
    <div class="card card-default">
        <div class="card-header">
            Комментарии
        </div>
        <div class="card">
            <form action="" id="sort_form">
                <label for="date">Дата</label>
                <select name="date" id="date">
                    <option selected value="no"></option>
                    <option value="">по возрастанию</option>
                    <option value="DESC">по убыванию</option>
                </select>
                <label for="email">E-mail</label>
                <select name="email" id="email">
                    <option selected value="no"></option>
                    <option value="">по возрастанию</option>
                    <option value="DESC">по убыванию</option>
                </select>
                <label for="name">Имя</label>
                <select name="name" id="name">
                    <option selected value="no"></option>
                    <option value="">по возрастанию</option>
                    <option value="DESC">по убыванию</option>
                </select>
            </form>
        </div>
        <ul class="card-body" id="result_sort">
            <?php foreach ($comments as $comment){?>
            <p class="card-text">
                <?=$comment['name']?>  <?=$comment['date']?><br>
                Фото: <img width='100px' height='100px' src='<?=$comment['photo']?>'><br>
                Комментарий: <?=$comment['message']?><br>
                E-mail: <?=$comment['email']?><br>
            </p>
            <?php }?>
        </ul>
        <form class="card-footer" action="" method="post" id="ajax_form" enctype="multipart/form-data">
            <div class="form-group">
                <label for="">Имя</label>
                <input type="text" class="form-control" name="name" placeholder="введите ваше имя" required>
            </div>
            <div class="form-group">
                <label for="">Email</label>
                <input type="text" class="form-control" name="email" placeholder="введите ваш e-mail" required>
            </div>
            <div class="form-group">
                <input type="file" class="form-control-file" name="photo">
            </div>
            <div class="form-group">
                <textarea class="form-control" name="message" rows="3" placeholder="Комментарий..."></textarea>
            </div>
            <div class="form-group">
                <input class="form-control" id="btn" type="submit" value="Отправить">
            </div>

        </form>

        <div id="result_form"></div>
    </div>
</div>
</body>

</html>