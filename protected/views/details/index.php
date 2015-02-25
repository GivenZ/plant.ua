<?php if(!empty($_GET['name'])): ?>
<?php
    $this->breadcrumbs=array('Проекты'=>array('profile/index'), $_GET['name'],);
    $this->pageTitle="Профиля проекта &mdash; ".$_GET['name'];
    endif;
?>
<div class="bs-docs-grid">
<div class="row show-grid">
    <div class="col-xs-12 col-md-8">
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Зарядка штрипса',
                'context' => 'primary',
                'size' => 'large',
                'icon'=>'glyphicon glyphicon-arrow-up',
            )
        );
        ?>
    </div>
    <div class="col-xs-6 col-md-4">
        <fieldset disabled>
        <?php $this->widget(
            'booster.widgets.TbSwitch',
            array(
                'name' => 'testToggleButtonB',
                'options' => array(
                    'size' => 'large', //null, 'mini', 'small', 'normal', 'large
                    'onColor' => 'success', // 'primary', 'info', 'success', 'warning', 'danger', 'default'
                    'offColor' => 'danger', // 'primary', 'info', 'success', 'warning', 'danger', 'default'
                ),
            )
            );
        ?>
        </fieldset>
    </div>
</div>
<?php
echo "<pre>";
echo $_GET['profile_id'];
echo "</pre>"
?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <?php
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Старт',
                'context' => 'success',
                'size' => 'large',
                'icon'=>'glyphicon glyphicon-upload',
                'buttonType' =>'link',
                'url'=>array('list/'.$_GET['profile_id']),
            )
        ); echo ' ';
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Пауза',
                'context' => 'warning',
                'size' => 'large',
                'icon'=>'glyphicon glyphicon-pause',
            )
        ); echo ' ';
        $this->widget(
            'booster.widgets.TbButton',
            array(
                'label' => 'Стоп',
                'context' => 'danger',
                'size' => 'large',
                'icon'=>'glyphicon glyphicon-stop',
            )
            );
        ?>
    </div>
</div>
</div>
<?php $this->widget('booster.widgets.TbGridView', array(
    'type' => 'striped hover bordered',
	'dataProvider'=>$dataProvider,
	'columns'=>array(
        //'id',
        array(
            'name'=>'id',
            'headerHtmlOptions'=>array('style'=>'width: 60px'),
        ),
		array(
			'name'=>'length',
			'type'=>'raw',
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
			'name'=>'profile_id',
			'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->profile_id), $data->url)'
		),
        array(
            'class'=>'booster.widgets.TbButtonColumn',
            'template' => "{insert}",
            'buttons' => array(
                'insert' => array(
                    'label' => 'Отправить',
                    //'url'=>'"http://some-url.com/emp/".$data->length',
                    //'url'=>'"http://213.186.98.16/VarStateRedirect.mwsl?PriNav=PriNav&v1=length&modifyvalue_t1=".$data->length."&gobutton_t1=Go&v2=number&modifyvalue_t2=".$data->quantity."&gobutton_t2=Go"',
                    //'url'=>'"http://213.186.98.16/VarStateRedirect.mwsl?PriNav=Varstate&v1=%22Data_block_recipes%22.Length%5B1%5D&t1=DEC&modifyvalue_t1=".$data->length."&gobutton_t1=Go&v2=%22Data_block_recipes%22.ListNumber%5B1%5D&t2=DEC&modifyvalue_t2=".$data->quantity."&gobutton_t2=Go"',
                    //'url'=>'"http://213.186.98.16/VarStateRedirect.mwsl?PriNav=Varstate&v1=Varstate&v1=%22Data_block_recipes%22.Length%5B1%5D&modifyvalue_t1=".$data->length."&gobutton_t1=Go&v2=%22Data_block_recipes%22.ListNumber%5B1%5D&modifyvalue_t2=".$data->quantity."&gobutton_t2=Go"',
                    //'url'=>'/details/lis',
                    'options' => array(
                        "class" => "btn btn-mini btn-success",
                    )
                ),
            )
        ),
	),
)); ?>