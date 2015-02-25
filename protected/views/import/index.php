<?php $this->beginWidget(
    'booster.widgets.TbJumbotron',
    array(
    'heading' => 'Загрузка проекта',
    )
); ?>
     
<?php if(Yii::app()->user->hasFlash('sucess')): ?>

<div class="alert in fade alert-success">
    <?php echo Yii::app()->user->getFlash('sucess'); ?>
</div>

<?php endif; ?>

<fieldset>
<?php echo CHtml::beginForm('', 'post', array('enctype'=>'multipart/form-data')); ?>


<?php echo CHtml::fileField('import', '', array('class' => 'col-sm-5')); ?>



<?php //echo CHtml::submitButton('Submit'); ?>
<div class="row">
    <div class="col-xs-12 col-md-12">
        <?php $this->widget(
            'booster.widgets.TbButton',
            array(
                'buttonType' => 'submit',
                'context' => 'primary',
                'label' => 'Загрузить'
            )
        ); ?>
            <?php $this->widget(
            'booster.widgets.TbButton',
            array('buttonType' => 'reset', 'label' => 'Сбросить')
        ); ?>
    </div>
</div>
<?php echo CHtml::endForm(); ?>
</fieldset>


<?php $this->endWidget(); ?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/filedrag.js"></script>