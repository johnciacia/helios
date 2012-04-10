<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'rubric-meta-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rubric_id'); ?>
		<?php
			$data = Rubric::model()->findAll(
				array(
					'condition' => 'user_id=:user_id', 
					'params' => array( ':user_id' => Yii::app()->user->id ) 
				)
			);

			$rubric_list = CHtml::listData( $data, 'id', 'title' );
			echo $form->dropDownList($model, 'rubric_id', $rubric_list );
		?>
		<?php echo $form->error($model,'rubric_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_label'); ?>
		<?php echo $form->textArea($model,'item_label',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'item_label'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'item_type'); ?>
		<?php echo $form->textField($model,'item_type'); ?>
		<?php echo $form->error($model,'item_type'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->