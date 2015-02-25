<!--<div class="formCon">
<div class="formConInner">-->

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>

    <td valign="top">




<h1>IMPORT EXCEL SHEET</h1>

<?php if(Yii::app()->user->hasFlash('sucess')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('sucess'); ?>
</div>

<?php endif; ?>

<div style="background-color: #E6E4E4;">
<table width="100%" cellspacing="2" cellpadding="2">

<tr>
<?php echo CHtml::beginForm('', 'post', array('enctype'=>'multipart/form-data')); ?>
<tr><td>&nbsp;</td></tr>
<td><?php echo CHtml::label('File to Import', 'fti'); ?> 
<?php echo CHtml::fileField('import', '', array('id'=>'fti')); ?></td>
</tr>

<tr>

<td><?php echo CHtml::submitButton('Submit'); ?> </td>


</tr>

<?php echo CHtml::endForm(); ?>
</tr>
</table>


</div>
    </td>

</table>


<!--</div>
</div>-->