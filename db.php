<?php

class Db
{
    private static $instance;
    private $connection;
    private $last_query;
    public static $k = "db class";

    private function __construct()
    {
        $this->setConnection();
    }

    private function __clone()
    {
        // TODO: Implement __clone() method.
    }

    public function getInstance()
    {
        return !(static::$instance instanceof self)? static::$instance = new self():static::$instance;
    }

    private function setConnection()
    {
        $this->connection = mysqli_connect('127.0.0.1','root','$Patron580','texode_comments');
        $this->connection?:die('Соединение с базой данных не установлено');
    }

    public function query($sql)
    {
      $this->last_query = $sql;
      $result = mysqli_query($this->connection,$sql);
      return $result;
    }

    private function confirm_query($result)
    {
        $result?:die('Не удалось выполнить запрос к базе данных<br/>'.$this->last_query);
    }

    public function escape($str)
    {
        return mysqli_real_escape_string($this->connection,$str);
    }

    public function fetch_assoc($result)
    {
        mysqli_fetch_assoc($result);
    }
}