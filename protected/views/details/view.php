<?php
/* @var $this DetailsController */
/* @var $model Details */

$this->breadcrumbs=array(
	'Details'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Details', 'url'=>array('index')),
	array('label'=>'Create Details', 'url'=>array('create')),
	array('label'=>'Update Details', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Details', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Details', 'url'=>array('admin')),
);
?>

<h1>View Details #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'profile_id',
		'length',
		'quantity',
		'status',
	),
)); ?>
