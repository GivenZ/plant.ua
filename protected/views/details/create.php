<?php
/* @var $this DetailsController */
/* @var $model Details */

$this->breadcrumbs=array(
	'Details'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Details', 'url'=>array('index')),
	array('label'=>'Manage Details', 'url'=>array('admin')),
);
?>

<h1>Create Details</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>