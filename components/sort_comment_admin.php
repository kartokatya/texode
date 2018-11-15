<?php

require_once($_SERVER['DOCUMENT_ROOT'].'/classes/Comment.php');

if($_POST['name'] !== 'no'){
    $sort = " name ".$_POST['name'];
}elseif ($_POST['email'] !== 'no'){
    $sort = " email ".$_POST['email'];
}else{
    $sort = " date ".$_POST['date'];
}
$comments = Comment::getComments($sort);



foreach ($comments as $comment){?>
    <p class="card-text">
        <?=$comment['name']?>  <?=$comment['date']?><br>
        Фото: <img width='100px' height='100px' src='<?=$comment['photo']?>'><br>
        Комментарий: <?=$comment['message']?><br>
        E-mail: <?=$comment['email']?><br>
    </p>
    <form action="/admin/dashboard.php" method="post">
        <input type="hidden" name="id" value="<?=$comment['id']?>">
        <input type="submit" name="submit" value="delete">
    </form>
<?php }?>
