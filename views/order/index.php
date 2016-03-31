<?php
use yii\helpers\ArrayHelper;
use \yii\helpers\Url;

?>

<div class="body-content">


    <?php $form = \yii\bootstrap\ActiveForm::begin(['action' => Url::to(['/ajax/validate-address']),
        'id' => 'make_order_form',
        'enableClientValidation' => false]);

    echo '<div style="width: 50%">';
    echo $form->field($address, 'items')->dropDownList(ArrayHelper::map($items, 'id', 'name-price'), ['multiple' => true]);
    echo '</div>';

    $address->address_type = '0';
    echo $form->field($address, 'address_type')->radioList(['0' => 'Shop', '1' => 'Home'])
        ->label('Выберите тип доставки');

    echo '<div style="width: 50%">';
    echo $form->field($address, 'shop_city');
    echo $form->field($address, 'shop_street');
    echo $form->field($address, 'shop_house_number');
    echo $form->field($address, 'client_city');
    echo $form->field($address, 'client_street');
    echo $form->field($address, 'client_house_number');
    echo '</div>';
    echo \yii\helpers\Html::submitButton('Create', ['class' => 'btn btn-success']);

    \yii\bootstrap\ActiveForm::end();
    ?>


</div>