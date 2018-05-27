<?php
    if (isset($_POST['login'])) { $login = $_POST['login']; if ($login == '') { unset($login);} } 
    if (isset($_POST['password'])) { $password=$_POST['password']; if ($password =='') { unset($password);} }
    if (isset($_POST['email'])) { $email = $_POST['email']; if ($email == '') { unset($email);} } 
    if (empty($login) or empty($password) or empty($email)) 
    {
    exit ("Вы ввели не всю информацию");
    }
    $login = stripslashes($login);
    $login = htmlspecialchars($login);
    $password = stripslashes($password);
    $password = htmlspecialchars($password);
    $email = stripslashes($email);
    $email = htmlspecialchars($email);
    $login = trim($login);
    $password = trim($password);
    $email = trim($email);
    $db = mysqli_connect ("localhost","root","", "trainstation");
    $result = mysqli_query($db,"SELECT id FROM users WHERE login='$login'");
    $myrow = mysqli_fetch_array($result);
    if (!empty($myrow['id'])) {
    exit ("Введите другой логин.");
    }
    $result2 = mysqli_query($db,"INSERT INTO users (login,password, email) VALUES('$login','$password', '$email')");
    if ($result2=='TRUE')
    {
    echo "Вы успешно зарегистрированы!<a href='index.php'>Главная страница</a>";
    }
    else {
    echo "Ошибка! Вы не зарегистрированы.";
    }
?>