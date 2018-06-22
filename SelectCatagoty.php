<?php 
session_start();
include ("db.php");
if (isset($_POST["name"])){
$name = $_POST["name"];
}
if (isset($_POST["sort"])){
$sort = $_POST["sort"];
}
else {
$sort = 'DESC';
}
if (isset($_POST["name"])){
$_SESSION['catname']=$name;
}
$products = array();
if ($result = $mysqli->query("SELECT * FROM products Where CatName='{$_SESSION['catname']}' 
  ORDER BY `price` $sort")) {
    while($tmp = $result->fetch_assoc()) {
        $products[] = $tmp;
    }
    $result->close();
}
 foreach($products AS $product) {?>
  <div class="col-lg-4 col-md-6 mb-4">
  <div  class="card h-100">
  <a href="#"><img class="card-img-top" src="<?php echo $product['img'];?>" alt=""></a>
  <div class="card-body">
  <h4 class="card-title">
  <a href="#"><?php echo $product['title'];?></a>
  </h4>
  <h5><?php echo $product['price'];?>₴</h5>
  <p class="card-text"><?php echo $product['intro'];?></p>
  <p class="rate">Покупаемость: <?php $result=$mysqli->query("SELECT round(rate('{$product['title']}')) AS `rate`");
                  $temp=$result->fetch_assoc();
                  if($temp['rate']!=""){
                    echo $temp['rate'] . "%</p>";
                  }
                  else {
                    echo "Еще не покупали </p>";
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
