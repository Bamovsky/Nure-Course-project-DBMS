<!DOCTYPE html>
<html lang="ru" >

<head>
  <meta charset="UTF-8">
  <title>Nure Login Form</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>
  <link rel="stylesheet" href="css/reg.css">
</head>
<body> 
<div class="container">
</div>
<div class="form">
  <div class="thumbnail"><img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/169963/hat.svg"/></div>
  <form class="register-form" action="SaveUser.php" method="POST">
    <input name="login" type="text" placeholder="Логин"/>
    <input name="password" type="password" placeholder="Пароль"/>
    <input name="email" type="text" placeholder="Email"/>
    <button>Создать</button>
    <p class="message">Уже зарегистрированны? <a href="#">Войти</a></p>
  </form>
  <form class="login-form" action="SingUp.php" method="POST">
    <input name="login"  type="text" placeholder="Логин"/>
    <input name="password" type="password" placeholder="Пароль"/>
    <button>Войти</button>
    <p class="message">Не зарегистрированны? <a href="#">Создать аккаунт</a></p>
  </form>
</div>
  <script src='vendor/jquery/jquery.min.js'></script>
  <script  src="js/reg.js"></script>
</body>
</html>
