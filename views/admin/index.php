<H3>Admin</H3>


<?php foreach ($model as $m): ?>
    <?php echo '<div class="address-block">Заказ №' . $m->id . '<br>' . getFullAddress($m); ?>
    <?php echo 'Товары:<br>' ?>
    <?php foreach ($m->getSavedItems()->all() as $save_item): ?>
        <?php $item = $save_item->getItem()->one(); ?>
        <?= $item->name; ?> <?= $item->price; ?> <br/>
    <?php endforeach; ?>
    <?php echo '<b>Общая сумма</b>: ' . $m->price . '<br>'; ?>
    <?php echo '</div><br>'; ?>
<?php endforeach; ?>


<?php


/**
 * Формирует строку заказа
 * @param $object
 * @return string
 */
function getFullAddress($object)
{
    $str = '';
    if (strlen($object->client_city) > 0) {
        $str .= 'Город заказчика: ' . $object->client_city . "<br>";
    }
    if (strlen($object->client_street) > 0) {
        $str .= 'Улица заказчика: ' . $object->client_street . "<br>";
    }
    if (strlen($object->client_house_number) > 0) {
        $str .= 'Номер дома заказчика: ' . $object->client_house_number . "<br>";
    }
    if (strlen($object->shop_city) > 0) {
        $str .= 'Город магазина: ' . $object->shop_city . "<br>";
    }
    if (strlen($object->shop_street) > 0) {
        $str .= 'Улица магазина: ' . $object->shop_street . "<br>";
    }
    if (strlen($object->shop_house_number) > 0) {
        $str .= 'Номер дома магазина: ' . $object->shop_house_number . "<br>";
    }

    return $str;
}

?>