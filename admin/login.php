<?php
session_start();
if (isset($_POST['submit']) || (isset($_SESSION))){
    if(($_POST['login'] == 'admin' && $_POST['password'] == '123')||($_SESSION['login'] == 'admin' && $_SESSION['password'] == '123')){
        $_SESSION['login'] = 'admin';
        $_SESSION['password'] = '123';
        header("Location: dashboard.php");

        exit;
    }else{
        echo "Неверный логин или пароль";
    }
}

?>
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">
    <label for=""><p>Логин</p><input type="text" name="login" required value="<?=$_SESSION['login']?>"></label>
    <label for=""><p>Пароль</p><input type="password" name="password" required value="<?=$_SESSION['password']?>"></label>
    <br><br>
    <input type="submit" name="submit" value="Войти">
</form>
