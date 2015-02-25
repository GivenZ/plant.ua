<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Авторизация';

?>

<h1>Авторизация</h1>

<?php
    /** @var TbActiveForm $form */
    $form = $this->beginWidget(
    'booster.widgets.TbActiveForm',
    array(
    'id' => 'login-form',
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'well'), // for inset effect
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
    )
    );
     
    echo $form->textFieldGroup($model, 'username');
    echo $form->error($model,'username');
    echo $form->passwordFieldGroup($model, 'password');
    echo $form->error($model,'password');
    echo $form->checkboxGroup($model, 'rememberMe');
    echo $form->error($model,'rememberMe');
    $this->widget(
    'booster.widgets.TbButton',
    array('buttonType' => 'submit', 'label' => 'Вход')
    );
     
    $this->endWidget();
    unset($form);
?>
