<?php
session_start();
include ("db.php");
require_once('cart.class.php');
require_once('cookie.class.php');

$cart = new Cart();

$action = isset($_GET['action']) ? $_GET['action'] : 'list';

if ($action == 'add') {
    $id = $_GET['id'];
    $cart->addProduct($id);
}
elseif ($action == 'delete') {
    $id = $_GET['id'];
    $cart->deleteProduct($id);
}
elseif ($action == 'clear') {
    $cart->clear();
    header('Location: cart.php');
}

$products = array();


$id_sql = $cart->getProducts(true);
$sql = "SELECT * FROM products WHERE id IN ( {$id_sql} )";
$result = $mysqli->query($sql);
if ($result){
while($tmp = $result->fetch_assoc()) {
        $products[] = $tmp;
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Корзина</title>
	<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/cart.css">
</head>
<body>
<h1>Ваша Корзина</h1>
<form>
<ul class="dotted">
	<?php 
	$i=0;
	if ($result){
	foreach ($products AS $product) {
	echo "<li><span>{$product['title']}</span><span>{$product['price']} ₴</span></li> 
	<div class='but'>
	<a id='deletes' href='cart.php?action=delete&id={$product['id']}''>Удалить из корзины</a>
	<input class='quantity' name='order{$i}' type='text' placeholder='Количество?'>
	</div>";
	$i++;
}
}
?>
</ul>
</form>
<div id="result"></div>
<div id="buttonWrap">
<?php if (isset($_SESSION['login'])) {?>
<a id="getOrder" class="buttons" href="#">Оформить заказ</a>
<?php } ?>
<a class="buttons" href="cart.php?action=clear&id=<?php echo $product['id'];?>">Очистить корзину</a>
<a class="buttons" href="index.php">Вернутся на главную</a>
</div>
<script src="vendor/jquery/jquery.min.js"></script>
<script src="js/cart.js"></script>
</body>
</html>

