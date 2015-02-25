<?php
$this->breadcrumbs=array(
	'Проекты'=>array('index'),
	'Manage',
);

$this->menu=array(
    array('label'=>'Создать проект','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('project-grid', {
    data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Администрирование проектов</h1>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
	<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('booster.widgets.TbGridView',array(
    'type' => 'striped hover bordered',
    'id'=>'project-grid',
    'dataProvider'=>$model->search(),
    'columns'=>array(
		//'id',
        array(
            'name'=>'id',
            'headerHtmlOptions'=>array('style'=>'width: 60px'),
        ),
        array(
            'name'=>'projectname',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->projectname), $data->url)'
        ),
		//'projectname',
        array(
            'class'=>'booster.widgets.TbButtonColumn',
            'htmlOptions' => array('nowrap'=>'nowrap'),
        ),
    ),
)); ?>