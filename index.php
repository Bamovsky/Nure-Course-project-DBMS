<?php 
session_start();
include ("db.php");
$categories = array();
if ($result = $mysqli->query('SELECT * FROM categories ORDER BY title')) {
    while($tmp = $result->fetch_assoc()) {
        $categories[] = $tmp;
    }
    $result->close();
}
$products = array();
if ($result = $mysqli->query("SELECT * FROM products Where CatName LIKE 'Телефоны'")) {
    while($tmp = $result->fetch_assoc()) {
        $products[] = $tmp;
    }
    $result->close();
}
?>

<!DOCTYPE html>
<html lang="ru">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Nure Shop</title>
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/shop-homepage.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php">Nure Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
          <li  class="nav-item active">
            <input id="search" type="text" placeholder="Что ищете?">
          </li>
            <li class="nav-item active">
              <a class="nav-link" href="index.php">Главная
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <?php if(isset($_SESSION['IsManager']) ){ 
              if ($_SESSION['IsManager']){
            ?>
            <li class="nav-item">
              <a id="manager" class="nav-link" href="#">Заказы</a>
            </li>
            <?php } } ?>
            <li class="nav-item">
              <a  class="nav-link" href="cart.php">Корзина</a>
            </li>
            <li class="nav-item">
              <a id="map" class="nav-link" href="#">Где нас найти</a>
            </li>
            <li class="nav-item">
              <?php if (isset($_SESSION['login'])){
                 echo "<a id='settings' class='nav-link' href='#'>Здраствуйте {$_SESSION['login']}</a>";
              }
              else{
                 echo "<a class='nav-link' href='reg.php'>Вход</a>";
            } ?>
            </li>
            <li class="nav-item">
              <?php if (isset($_SESSION['login'])) {?>
              <a class="nav-link" href="Exit.php">Выйти</a>
            <?php } ?>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        <div class="col-lg-3">

          <h1 class="my-4">Категории</h1>
          
          <div id="cat" class="list-group">
            <?php
           foreach($categories AS $category) {
                echo ' <a  class="list-group-item">' . 
                $category['title'] .'</a>';
            }
            ?>
          </div>
<div>
  <label>
    <input type="radio" class="option-input radio" name="sort" checked />
    По убыванию
  </label>
  <label>
    <input type="radio" class="option-input radio" name="sort" />
    По возрастанию
  </label>
</div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9 fixed">
          <div id="product" class="row">

            <?php foreach($products AS $product) {?>
            <div class="col-lg-4 col-md-6 mb-4">
              <div  class="card h-100">
                <a href="#"><img class="card-img-top" src="<?php echo $product['img'];?>" alt=""></a>
                <div class="card-body">
                  <h4 class="card-title">
                    <a href="#"><?php echo $product['title'];?></a>
                  </h4>
                  <h5><?php echo $product['price'];?>₴</h5>
                  <p class="card-text"><?php echo $product['intro'];?></p>
                  <p class="rate">Покупаемость: <?php $result=$mysqli->query("SELECT round(rate('{$product['title']}'),2) AS `rate`");
                  $temp=$result->fetch_assoc();
                  if($temp['rate']!=""){
                    echo $temp['rate'] . "%</p>";
                  }
                  else {
                    echo "Еще не покупали";
                  }
                  ?>
                  <p> Осталось: <?php echo $product['quantity'] . "</p>"; ?>
                </div>
                <div class="card-footer">
                 <a href='#' id='add-<?php echo $product['id'];?>'>Добавить в корзину</a>
                </div>
              </div>
            </div>
          <?php }?>
          </div>
          <!-- /.row -->

        </div>
        <!-- /.col-lg-9 -->

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Черкашин АКТСИу 17-2</p>
      </div>
    </footer>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
  </body>

</html>
