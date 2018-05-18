<?php 
include ("db.php");
$name = $_POST["name"];
$products = array();
if ($result = $mysqli->query("SELECT * FROM products Where CatName='$name'")) {
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
<h5><?php echo $product['price'];?></h5>
<p class="card-text"><?php echo $product['intro'];?></p>
</div>
<div class="card-footer">
<small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
</div>
</div>
</div>
<?php } ?>
