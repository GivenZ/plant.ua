<?php
$this->breadcrumbs=array(
	'Проекты'=>array('index'),
	'Создать',
);
$this->pageTitle=Yii::app()->name . ' - Создать проект';
$this->menu=array(
    array('label'=>'Проекты','url'=>array('index')),
);
?>

<h1>Создать проект</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>