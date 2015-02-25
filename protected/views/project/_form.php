<?php $form=$this->beginWidget('booster.widgets.TbActiveForm',array(
	'id'=>'project-form',
	'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Поля, отмеченные <span class="required">*</span> обязательны для заполнения.</p>

    <?php echo $form->errorSummary($model); ?>

	<!--<?php echo $form->textFieldGroup($model,'projectname',array('widgetOptions'=>array('htmlOptions'=>array('class'=>'span5','maxlength'=>128)))); ?>
-->

	<div class="row">
		<?php echo $form->labelEx($model,'projectname'); ?>
		<?php echo $form->textField($model,'projectname',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'projectname'); ?>
	</div>

    <div class="form-actions">
    	<?php $this->widget('booster.widgets.TbButton', array(
    			'buttonType'=>'submit',
    			'context'=>'primary',
    			'label'=>$model->isNewRecord ? 'Create' : 'Save',
    		)); ?>
    </div>

<?php $this->endWidget(); ?>
