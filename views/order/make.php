<?php 

use \yii\helpers\Url;
?>
<div>
	
	<h4><?=$item['name']; ?></h4>
	<?php $form = \yii\bootstrap\ActiveForm::begin(['action' =>  Url::to(['/ajax/validate-address']),
												    'id'=>'makeorder_form',
								                    'enableClientValidation' => false ]);
	$address->addr_type = '0';		
	echo  $form->field($address, 'addr_type')->radioList(['0'=>'Shop','1'=>'Home'])
														->label('Выберите тип доставки'); 

    echo '<div style="width: 50%">';													
    echo $form->field($address,'shop_city');
    echo $form->field($address,'shop_street');
    echo $form->field($address,'shop_house_number');
    echo $form->field($address,'client_city');
    echo $form->field($address,'client_street');
    echo $form->field($address,'client_house_number');
    echo '</div>';
	echo \yii\helpers\Html::submitButton('Create',['class' => 'btn btn-success']); 

	\yii\bootstrap\ActiveForm::end();
	?>
</div>