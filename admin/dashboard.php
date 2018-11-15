<?php
require_once($_SERVER['DOCUMENT_ROOT'].'/classes/Comment.php');
$comments = Comment::getComments();
if(isset($_POST['submit'])){
 $delete = Comment::deleteComments($_POST['id']);
}
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
    <script src="/assets/js/ajax.js"></script>
</head>
<body>
<div class="col-md-9">
    <div class=""><a href="/">На главную</a></div>
    <div class="card card-default">
        <div class="card-header">
            Комментарии
        </div>
        <div class="card">
            <form action="" id="sort_form_reg">
                <label for="date">Дата</label>
                <select name="date" id="date_ad">
                    <option selected value="no"></option>
                    <option value="">по возрастанию</option>
                    <option value="DESC">по убыванию</option>
                </select>
                <label for="email">E-mail</label>
                <select name="email" id="email_ad">
                    <option selected value="no"></option>
                    <option value="">по возрастанию</option>
                    <option value="DESC">по убыванию</option>
                </select>
                <label for="name">Имя</label>
                <select name="name" id="name_ad">
                    <option selected value="no"></option>
                    <option value="">по возрастанию</option>
                    <option value="DESC">по убыванию</option>
                </select>
            </form>
        </div>
        <ul class="card-body" id="result_sort">
            <?php foreach ($comments as $comment){?>
                <p class="card-text">
                    <?=$comment['id']?>
                    <?=$comment['name']?>  <?=$comment['date']?><br>
                    Фото: <img width='100px' height='100px' src='<?=$comment['photo']?>'><br>
                    Комментарий: <?=$comment['message']?><br>
                    E-mail: <?=$comment['email']?><br>
                </p>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="id" value="<?=$comment['id']?>">
                    <input type="submit" name="submit" value="delete">
                </form>
            <?php }?>
        </ul>
    </div>
</div>
</body>

</html>