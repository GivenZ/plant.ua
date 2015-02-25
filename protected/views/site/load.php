
<div class="form">

<?php
$form = $this->beginWidget('booster.widgets.TbActiveForm', array(
'id'=>'service-form',
'enableAjaxValidation'=>false,
'method'=>'post',
'type'=>'horizontal',
'htmlOptions'=>array(
    'enctype'=>'multipart/form-data'
)
)); ?>

<fieldset>



    <div class="control-group">     
        <div class="span4">
                            
    <?php echo $form->labelEx($model,'file'); ?>
    <?php echo $form->fileField($model,'file'); ?>
    <?php echo $form->error($model,'file'); ?>
                        </div>


        </div>
    </div>

    <div class="form-actions">
        <?php $this->widget('booster.widgets.TbButton', array('icon'=>'ok white', 'label'=>'UPLOAD')); ?>
        <?php $this->widget('booster.widgets.TbButton', array('icon'=>'remove', 'label'=>'Reset')); ?>
    </div>

  <div class="row buttons">
    <?php echo CHtml::submitButton('Загрузить', array('class'=>'btn btn-default')); ?>
  </div>
</fieldset>

<?php $this->endWidget(); ?>

</div><!-- form -->