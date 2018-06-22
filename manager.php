<?php
include ("db.php");
if (isset($_POST["manager"])){
    $mysqli->query("DELETE FROM `orders` WHERE `orders`.`id` ='{$_POST['manager']}'");
    $mysqli->commit();
}
$orders = array();
if ($result = $mysqli->query("SELECT * FROM `orders`")) {
    while($tmp = $result->fetch_assoc()) {
        $orders[] = $tmp;
    }
    $result->close();
}

?>

<div class="order">
    <button id="historyOrder">История заказов</button>
    <button id="currentOrder">Текущие заказы</button>
</div>

<?php
echo "<table  id='table1'>"; ?>
<tr>
    <td align='center'>№</td>
    <td align='center'>Имя покупателя</td>
    <td align='center'>Товар</td>
    <td align='center'>Время заказа</td>
    <td align='center'>Цена за ед.</td>
    <td align='center'>Кол-во</td>
</tr>
<?php
/// начало таблицы
foreach($orders as $value) {
        echo "<tr>"; // начинаем строку
        foreach($value as $key=>$val) {
                echo "<td align='center'>"; // выводим начало ячейки
                echo $val;
                echo "</td>"; // выводим конец ячейки
        }
        echo "<td><button class='compleate' id='complete-{$value['id']}'>Выполнено</button></td>";
        echo "</tr>"; // заканчиваем строку
}
echo "</table>"; // конец таблицы
?>