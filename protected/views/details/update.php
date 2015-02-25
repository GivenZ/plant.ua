<?php
/* @var $this DetailsController */
/* @var $model Details */

$this->breadcrumbs=array(
	'Details'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Details', 'url'=>array('index')),
	array('label'=>'Create Details', 'url'=>array('create')),
	array('label'=>'View Details', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Details', 'url'=>array('admin')),
);
?>

<h1>Update Details <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>