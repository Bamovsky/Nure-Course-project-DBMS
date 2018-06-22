<?php 
session_start();
include ("db.php");
require_once('cart.class.php');
require_once('cookie.class.php');
$cart = new Cart();
if ($cart->getProducts(TRUE) == ""){
		echo 'Нет продуктов для заказа!!!';
		die();
}
$data = $_POST["data"];
$data=json_decode ($data);
$products = array();
$id_sql = $cart->getProducts(true);
$sql = "SELECT * FROM products WHERE id IN ( {$id_sql} )";
$result = $mysqli->query($sql);
if ($result){
while($tmp = $result->fetch_assoc()) {
        $products[] = $tmp;
}
}
	$error=FALSE;
	$i=0;
	for ($j=0;$j<count($data); $j++){
		if($data[$j]<0){
			echo "Запрещенно вводить отрицательные значения";
			die();
		}
	}

	foreach ($products as $product) {
	$tmp=$mysqli->query("SELECT `quantity` FROM `products` WHERE `title`='{$product['title']}'");
	$tmp=$tmp->fetch_assoc();
	if ($data[$i] <= $tmp['quantity']){
	$mysqli->query("INSERT INTO `orders` (`id`, `user`, `title`, `DateTime`, `price`,`quantity`) 
	VALUES (NULL, '{$_SESSION['login']}', '{$product['title']}', NOW(), '{$product['price']}', '{$data[$i]}')");
	$mysqli->commit();
	$cart->deleteProduct($product['id']);
	}
	else {
		echo "Такого количества {$product['title']} нет на складе";
		$error=TRUE;
	}
	$i++;
	}
	if ($error == FALSE){
	echo "Ваш заказ обработан, ожидайте письма менеджера <a href='index.php'>Вернутся на главную</a>";
}
?>
