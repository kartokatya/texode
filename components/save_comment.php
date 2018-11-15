<?php

require_once ($_SERVER['DOCUMENT_ROOT'].'/db.php');
require_once('../classes/Comment.php');

$db = Db::getInstance();


    $name = $db->escape($_POST['name']);
    $email = $db->escape($_POST['email']);
    $message = $db->escape($_POST['message']);
    $comment = new Comment($name,$email,$message);

    $comment->len(0,50,$comment->name,'Слишком длинное имя');
    $comment->len(0,200,$comment->message,'Слишком большой комментарий');
    $comment->ext('photo','Файл должен быть формата jpg,png или gif');

    if(empty($comment->getErrors()))
    {
        $photo = $comment->upload('photo');
        $date = $comment->date;

        echo $db->query("INSERT INTO comments(name,email,message,photo,date) VALUES (
'{$comment->name}','{$comment->email}','{$comment->message}','{$photo}','{$date}')")?"":
            'ошибка сохранения';
    }else{
        foreach ($comment->getErrors() as $error) {
            echo $error.'<br>';
        }
    }
