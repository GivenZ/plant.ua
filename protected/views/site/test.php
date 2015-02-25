<?php
$form = $this->beginWidget(
    'CActiveForm',
    array(
        'id' => 'test-form',
        'enableAjaxValidation' => false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
    )
);
// ...
echo $form->labelEx($model, 'import');
echo $form->fileField($model, 'import');
echo $form->error($model, 'import');

echo CHtml::submitButton('Submit', array('name'=>'submit'));

// ...
$this->endWidget();
?>