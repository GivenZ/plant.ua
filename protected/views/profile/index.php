<?php if(!empty($_GET['projectname'])): ?>
<?php
    $this->breadcrumbs=array('Проекты'=>array('project/index'), $_GET['projectname'],);
    $this->pageTitle="Профиля проекта &mdash; ".$_GET['projectname'];
    endif;
?>
<h1><i><?php echo "&nbsp;<span class=smallgray>Количество профилей: ".$countProjectProfiles."</span>"?></i></h1>

<?php

$this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped hover bordered',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
		array(
			'name'=>'name',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name), $data->url)'
		),
		array(
			'name'=>'quantity',
			'type'=>'raw',
		),
		array(
			'name'=>'status',
			'type'=>'raw',
		),
		array(
			'name'=>'project_id',
			'type'=>'raw',
		),
		array(
            'htmlOptions' => array('nowrap'=>'nowrap'),
			'class'=>'booster.widgets.TbButtonColumn',
		),
	),
)); ?>