<?php
session_start();
include ("db.php");
if (isset($_POST["data"])){
$data = $_POST["data"];
$data=json_decode($data, true);
$mysqli->query("UPDATE `userinfo` SET `Name`= '{$data['Name']}', `LastName`='{$data['LastName']}',
	`MiddleName`= '{$data['MiddleName']}', `cart`= '{$data['cart']}', `phone`= '{$data['phone']}',
	`addr`= '{$data['addr']}' WHERE `id`=(SELECT `idInfo` from `users` WHERE `login` = '{$_SESSION['login']}')
	");
$mysqli->commit();
}
$name=$mysqli->query("SELECT * FROM `userinfo` WHERE `id`=(SELECT `idInfo` from `users` WHERE `login` = '{$_SESSION['login']}') ");
$info = $name->fetch_assoc();

?>


<form id="application" >
   <input name="name" id="applicationName" maxlength="20" placeholder="<?php if($info['Name']){echo $info['Name'];} else {echo 'Введите имя';}?>" required />
   <input name="lastName" id="applicationLastName" maxlength="20" placeholder="<?php if($info['LastName']){echo $info['LastName'];} else {echo 'Введите Фамилию';}?>"" required />
   <input name="MiddleName" id="applicationMiddleName" maxlength="20" placeholder="<?php if($info['MiddleName']){echo $info['MiddleName'];} else {echo 'Введите Отчество';}?>"" required />
   <input name="cart" type="text" id="applicationCart" maxlength="20" placeholder="<?php if($info['cart']){echo $info['cart'];} else {echo 'Введите номер карты';}?>" required />
   <input name="telephone" type="Tel" id="applicationTelephone" maxlength="20" placeholder="<?php if($info['phone'] ){echo $info['phone'];} else {echo 'Введите номер телефона';}?>" required/>
   <input name="name" id="applicationAddr" maxlength="20" placeholder="<?php if($info['addr'] ){echo $info['addr'];} else {echo 'Введите адрес доставки';}?>" required />
   <button id="change" class="applicationButton" type="submit" form="application">Изменить</button>
</form>
