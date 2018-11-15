<?php
require_once ($_SERVER['DOCUMENT_ROOT'].'/db.php');

class Comment
{
    public $id;
    public $name;
    public $message;
    public $email;
    public $date;

    private $error = [];

    public function __construct($name,$email,$message)
    {
        $this->name= $name;
        $this->message = $message;
        $this->email = $email;
        $this->date = date('d.F.Y H:i:s');
    }

    public function len($min,$max,$var,$error)
    {
        !(strlen($var)>$max || strlen($var)<$min)?:$this->error[] = $error;
    }

    public function ext($filename, $error)
    {
        ($_FILES[$filename]['type'] == 'image/jpeg' || $_FILES[$filename]['type'] == 'image/png'
            || $_FILES[$filename]['type'] == 'image/gif')?:$this->error[] = $error;
    }

    public function getErrors()
    {
        return $this->error;
    }

    protected function randomString($length)
    {
        $characters = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";

        $strlength = strlen($characters);

        $random = '';

        for ($i = 0; $i < $length; $i++) {
            $random .= $characters[rand(0, $strlength - 1)];
        }
        return $random;
    }

    public function upload($filename)
    {

        if($_FILES[$filename]["size"] > 1024*2*1024)
        {
            echo ("Размер файла превышает два мегабайта");
            exit;
        }

        if(is_uploaded_file($_FILES[$filename]["tmp_name"]))
        {
            $path = "/upload/".$this->randomString(4).$_FILES[$filename]["name"];
            move_uploaded_file($_FILES[$filename]["tmp_name"],$_SERVER['DOCUMENT_ROOT'].$path);
            return $path;
        } else {
            echo("Ошибка загрузки файла");
        }
    }

    public static function getComments($sort = 'date DESC')
    {
        $db = Db::getInstance();
        $sql = "SELECT * FROM comments ORDER BY {$sort}";
        $comments = $db->query($sql);
        return $comments;
    }

    public static function deleteComments($id)
    {
        $db = Db::getInstance();
            $sql = "DELETE FROM comments WHERE id = '{$id}'";
        $comments = $db->query($sql);
        return $comments;

    }
}